const createRouter = require('koa-bestest-router');
const Koa = require('koa');
const koaBody = require('koa-body');
const mount = require('koa-mount');
const serve = require('koa-static');
// const sqlite3 = require('sqlite3').verbose();
const sqlite = require('sqlite');

// const db = new sqlite3.Database("db.sqlite");

// db.serialize(function () {
// 		db.run('CREATE TABLE pastes (short_url TEXT,\
// 								language TEXT,\
// 								insertion_date INTEGER,\
// 								expiration_date INTEGER,\
// 								num_views INTEGER,\
// 								max_views INTEGER,\
// 								public INTEGER,\
// 								author TEXT,\
// 								title TEXT,\
// 								content TEXT);',
// 			   (err) => {
// 				   console.error(err);
// 			   });
// });

(async () => {
	async function setupDb() {
		try {
			await db.run('CREATE TABLE pastes (short_url TEXT,\
						language TEXT,\
						insertion_date INTEGER,\
						expiration_date INTEGER,\
						num_views INTEGER,\
						max_views INTEGER,\
						public INTEGER,\
						author TEXT,\
						title TEXT,\
						content TEXT);');
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
		ctx.body = data[0];
	}

	async function handlePasteUpload(ctx, next) {
		const query = await db.prepare("SELECT COUNT(*) AS Count FROM pastes WHERE short_url = (?)");
		do {
			shortUrl = generateShortUrl();
			count = (await query.all(shortUrl))[0].Count;
			console.error(count);
		} while (count != 0)

		var stmt = await db.prepare("INSERT INTO pastes (short_url, author, title, content) VALUES (?, ?, ?, ?)");
		stmt.run(shortUrl, ctx.request.body['author'], ctx.request.body['title'], ctx.request.body['content']);
		ctx.status = 200;
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
