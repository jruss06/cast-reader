<?php

class Database 
{
	static function setup() {
		$dsn = 'mysql:dbname=cast_reader;host=127.0.0.1';
		$user = 'castReader';
		$password = 'castReader';

		try {
			$dbh = new PDO($dsn, $user, $password);
			return $dbh;
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
	}

    public function allPodcasts() {
        $db = $this->setup();
		$results = $db->query('select id,title,summary,url from podcasts');

		$podcasts = [];
		foreach($results as $row) {
			$podcasts[] = [
				'id' => $row['id'],
				'title' => $row['title'],
				'summary' => $row['summary'],
				'url' => $row['url']
	    	];
		}

		return $podcasts;
	}

    public function getPodcast($id) {
        $db = $this->setup();
		$command = $db->prepare('select id,title,summary,url from podcasts 
				where id=:id');
		$command->bindValue(':id', $id);
		$command->execute();

		$row = $command->fetch();
		$episode = array(
			'id' => $row['id'],
			'title' => $row['title'],
			'summary' => $row['summary'],
			'url' => $row['url']
		);
		
		return $episode;
	}

    public function addPodcast($title, $summary, $url) {
		$db = $this->setup();
		$command = $db->prepare('INSERT INTO podcasts (title, summary, url) 
				values (:title, :summary, :url)');
	
		$command->bindValue(':title', $title);
		$command->bindValue(':summary', $summary);
		$command->bindValue(':url', $url);

		$command->execute() or die(print_r($command->errorInfo(), true));
    }

    public function updatePodcast($id, $title, $summary, $url) {
        $db = $this->setup();
		$command = $db->prepare('update podcasts set title=:title, summary=:summary, url=:url where id=:id');
		$command->bindValue(':id', $id);
		$command->bindValue(':title', $title);
		$command->bindValue(':summary', trim($summary));
		$command->bindValue(':url', $url);
		$command->execute();
	}

    public function deletePodcast($id) {
		$db = $this->setup();
		$command = $db->prepare('delete from podcasts where id=:id');
		$command->bindValue(':id', $id);

		$command->execute() or die(print_r($command->errorInfo(), true));
    }

    public function allEpisodes() {
        $db = $this->setup();
		$results = $db->query('select title,summary,url,audio_url,pub_date from episodes order by pub_date DESC');

		$episodes = [];
		foreach($results as $row) {
	    	$episodes[] = [
				'title' => $row['title'],
				'summary' => $row['summary'],
				'url' => $row['url'],
				'audio' => $row['audio_url'],
				'date' => $row['pub_date']
	    	];
		}

		return $episodes;
	}

    public function latestEp($podcast_id) {
        $db = $this->setup();
		$command = $db->prepare('select title,summary,url,pub_date from episodes 
				where podcast_id=:id order by pub_date DESC');
		$command->bindValue(':id', $podcast_id);
		$command->execute();

		$row = $command->fetch();
	    $episode = array(
			'title' => $row['title'],
			'summary' => $row['summary'],
			'pub_date' => $row['pub_date']
		);
		
		return $episode;
	}

    public function addEpisode($item) {
		$db = $this->setup();
		$command = $db->prepare('INSERT INTO episodes (podcast_id, title, summary, url, pub_date, audio_url) 
				values (:podcast_id, :title, :summary, :url, :pub_date, :audio_url)');
	
		$command->bindValue(':podcast_id', $item['podcast_id']);
		$command->bindValue(':title', $item['title']);
		$command->bindValue(':summary', $item['summary']);
		$command->bindValue(':url', $item['url']);
		$command->bindValue(':pub_date', $item['pub_date']);
		$command->bindValue(':audio_url', $item['audio_url']);

		$command->execute() or die(print_r($command->errorInfo(), true));
    }
}

?>
