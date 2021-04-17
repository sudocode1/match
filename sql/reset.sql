USE ranker;
DROP TABLE IF EXISTS rankings;

CREATE TABLE rankings (
    id int NOT NULL UNIQUE,
    dataname text NOT NULL,
    datadesc text NOT NULL UNIQUE,
    score int DEFAULT 0,
    link text NOT NULL UNIQUE,
    ip text
)