const createRouter = require('koa-bestest-router');
const Koa = require('koa');
const koaBody = require('koa-body');
const mount = require('koa-mount');
const rewrite = require('koa-rewrite');
const serve = require('koa-static');
const sqlite = require('sqlite');

ALLOWED_LANGUAGES = ['Bash', 'C', 'Javascript', 'Python'];

(async () => {
	async function setupDb() {
		try {
			await db.run('CREATE TABLE pastes (\
						id TEXT,\
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

	let timerId = setInterval(() => clearExpiredPastes(), 60);

	async function deleteContentOf(id) {
		const query = await db.prepare("UPDATE pastes SET content = '' WHERE id = (?)");
		await query.run(id);
	}

	async function clearExpiredPastes() {
		const query = await db.prepare("SELECT id, expiration_date FROM pastes");

		var row;
		while((row = await query.get()))
		{
			if (Date.now() > row.expiration_date)
				deleteContentOf(row.id);
		}
		query.finalize();
	}

	function generateId() {
		return Math.random().toString(32).substring(2);
	}

	async function generateUniqueId() {
		const query = await db.prepare("SELECT COUNT(*) AS Count FROM pastes WHERE id = (?)");
		do {
			id = generateId();
			count = (await query.all(id))[0].Count;
		} while (count != 0)

		return id;
	}

	async function incrementViews(id)
	{
		const query = await db.prepare("UPDATE pastes SET num_views = num_views + 1 WHERE id = (?)");
		await query.run(id);
	}

	async function handleGetPaste(ctx, next) {
		if (ctx.query.id === undefined)
		{
			ctx.status = 404;
			await next();
			return ;
		}

		const query = await db.prepare("SELECT * FROM pastes WHERE id = (?)");
		const data = await query.all(ctx.query.id);
		if (data.length > 0)
		{
			ctx.status = 200;
			if ((data[0].max_views == -1 || data[0].num_views < data[0].max_views) &&
				(data[0].expiration_date == -1 || Date.now() < data[0].expiration_date))
			{
				ctx.body = data[0];
				incrementViews(ctx.query.id);
			}
			else
			{
				ctx.body = "Can't see anymore!";
			}
		}
		else
		{
			ctx.status = 404;
		}
		await next();
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
		if (values.public === undefined)
			values.public = 1;
		else
			values.public = 0;

		values.id = await generateUniqueId();

		var stmt = await db.prepare("INSERT INTO pastes (\
														id,\
														author,\
														title,\
														content,\
														language,\
														insertion_date,\
														expiration_date,\
														num_views,\
														max_views,\
														public\
														) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		await stmt.run(
						values.id,
						values.author,
						values.title,
						values.content,
						values.language,
						Date.now(),
						Date.now() + 60*1000,
						0,
						values.max_views,
						values.public
					  );

		ctx.status = 302;
		ctx.set('Location', ctx.origin + '/' + values.id);
		await next();
	}

	const api = new Koa();
	api.use(koaBody());
	const apiRouterMiddleware = createRouter({
		GET: {
			'/paste': handleGetPaste
		},
		POST: {
			'/paste': handlePasteUpload
		}
	}, true);
	api.use(apiRouterMiddleware);

	const app = new Koa();

	app.use(mount('/api', api));


	app.use(rewrite('/:id', '/paste.html'));
	app.use(rewrite('/', '/index.html'));

	app.use(serve('./statics/client'));

	app.listen(3000);
})();
