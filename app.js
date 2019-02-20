const createRouter = require('koa-bestest-router');
const Koa = require('koa');
const koaBody = require('koa-body');
const mount = require('koa-mount');
const serve = require('koa-static');
const sqlite = require('sqlite');

ALLOWED_LANGUAGES = ['Bash', 'C', 'Javascript', 'Python'];

(async () => {
	async function setupDb() {
		try {
			await db.run('CREATE TABLE pastes (\
						short_url TEXT,\
						author TEXT,\
						title TEXT,\
						content TEXT,\
						language TEXT,\
						insertion_date INTEGER,\
						expiration_date INTEGER,\
						num_views INTEGER,\
						max_views INTEGER,\
						public INTEGER\
						);');
		} catch (err) {
			console.error(err);
		}

	}
	const dbPromise = sqlite.open("db.sqlite", { Promise });

	const db = await dbPromise;
	await setupDb();

	function generateShortUrl() {
		return Math.random().toString(32).substring(2);
	}

	async function handleGetPaste(ctx, next) {
		const query = await db.prepare("SELECT * FROM pastes WHERE short_url = (?)");
		const data = await query.all(ctx.params.id);
		// TODO json stringify?
		ctx.body = data[0];
	}

	function getValues(body) {
		return {
			author: body['author'],
			title: body['title'],
			content: body['content'],
			language: body['language'],
			max_views: body['max_views'],
			public: body['public'],
		};
	}

	async function handlePasteUpload(ctx, next) {
		// We answer 404 when there is some missing parameters
		// https://stackoverflow.com/a/3050624

		var values = getValues(ctx.request.body);

		if (values.content === undefined || values.content.length < 1)
		{
			ctx.status = 404;
			await next();
			return ;
		}

		if (values.author === undefined || values.author.length < 1)
			values.author = "Anonymous";
		if (values.title === undefined || values.title.length < 1)
			values.title = "Untitled";
		if (values.language === undefined || ALLOWED_LANGUAGES.indexOf(values.language) == -1)
			values.language = "None";
		if (values.max_views === undefined || isNaN(parseInt(values.max_views)) || parseInt(values.max_views) < 1)
			values.max_views = -1;

		const query = await db.prepare("SELECT COUNT(*) AS Count FROM pastes WHERE short_url = (?)");
		do {
			shortUrl = generateShortUrl();
			count = (await query.all(shortUrl))[0].Count;
		} while (count != 0)

		var stmt = await db.prepare("INSERT INTO pastes (short_url, author, title, content, language, num_views, max_views) VALUES (?, ?, ?, ?, ?, ?, ?)");
		await stmt.run(shortUrl, values.author, values.title, values.content, values.language, 0, values.max_views);

		ctx.status = 200;
		await next();
	}

	const api = new Koa();
	api.use(koaBody());
	const apiRouterMiddleware = createRouter({
		GET: {
			'/paste/:id': handleGetPaste
		},
		POST: {
			'/paste': handlePasteUpload
		}
	}, true);
	api.use(apiRouterMiddleware);

	const statics = new Koa();
	statics.use(serve('./statics/'));

	const app = new Koa();
	app.use(mount('/api', api));
	app.use(mount('/', statics));
	const appRouterMiddleware = createRouter({
		GET: {
			'/:id': async (ctx, next) => {
				console.log(`${ctx.params.id}`);
			}
		},
	}, true);
	app.use(appRouterMiddleware);
	app.listen(3000);

	//db.close();
})();
