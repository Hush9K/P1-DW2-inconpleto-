BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "LOG" (
	"id_log"	INTEGER NOT NULL UNIQUE,
	"acao"	TEXT(35) NOT NULL,
	"data_hora_log"	datetime DEFAULT CURRENT_TIMESTAMP,
	"id_produto"	INTEGER NOT NULL,
	"user_insert"	TEXT NOT NULL,
	PRIMARY KEY("id_log" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "PRODUTO" (
	"id_produto"	INTEGER NOT NULL,
	"nome_produto"	TEXT(30) NOT NULL,
	"descricao"	TEXT(35),
	"preco"	REAL NOT NULL,
	"estoque"	INTEGER,
	"user_insert"	TEXT(30),
	"data_hora_produto"	datetime DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY("id_produto" AUTOINCREMENT)
);
COMMIT;
