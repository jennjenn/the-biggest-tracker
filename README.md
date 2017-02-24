The Biggest Tracker
===================

Simple weight loss tracking app for people running their own version of The Biggest Loser.
It's pretty hacky and I only sort of updated stuff for 2017 (and php 7), but it "works." There's some extra cruft I didn't clean up, but better than nothing!

### Setup
* DB connect is located in ```connect.php```. Enter the usual stuff here.
* Currently a few redirects are hard-coded into ```functions.php```. If you're installing this anywhere other than the root directory, you might want to update this.

---
### Setting up the DB
```
-- Create syntax for TABLE 'log'
CREATE TABLE `log` (
  `entryID` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`entryID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'users'
CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latest_percent_change` float DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
```

---

### TODO
* ~~registration page (because adding users straight to the DB is just weird)~~
* daily reminder emails
* ~~function to generate status blocks for ALL users from the DB instead of individual divs~~
* other stuff (highcharts, etc)

