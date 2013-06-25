The Biggest Tracker
===================

Simple tracking app for people running their own version of The Biggest Loser.
It's pretty hacky and all runs off of 1 page but it gets the job done. Right now it's designed for two users, but that's easily scaled by adding more user divs to the tracking page.

### Setup
* DB connect is located in ```connect.php```. Enter the usual stuff here.
* Users are entered directly into the DB. Either use a GUI or run ```INSERT INTO users (username, password, email) VALUES ('$username', md5('$password'), '$email')```
* Currently redirects are hard-coded into ```functions.php```. If you're installing this anywhere other than the root directory, you might want to update this.

---
### Setting up the DB
```
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `log` (
  `entryID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`entryID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
```

---

### TODO
* registration page (because adding users straight to the DB is just weird)
* daily reminder emails
* function to generate status blocks for ALL users from the DB instead of individual divs
* other stuff (highcharts, etc)

