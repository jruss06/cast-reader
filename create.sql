create TABLE podcasts (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    summary TEXT,
    url VARCHAR(255)
);

create TABLE episodes (
    id SERIAL PRIMARY KEY,
    podcast_id INT not null,
    mark_read bool default false,
    title VARCHAR(255),
    summary TEXT,
    url VARCHAR(255),
    pub_date Date,
    audio_url VARCHAR(255),
	podcast VARCHAR(255),
    FOREIGN KEY (podcast_id)
		REFERENCES podcasts (id)
);

INSERT INTO podcasts (title, summary, url) 
VALUES('Not Another D&D Podcast', 'Welcome to the campaign after the campaign! Three unlikely adventurers attempt to right the wrongs caused by a party of legendary heroes who screwed up the world while trying to save it. DM Brian Murphy is joined by Emily Axford, Jake Hurwitz, and Caldwell Tanner for this D&D play podcast.', 'https://rss.art19.com/not-another-d-and-d-podcast');

