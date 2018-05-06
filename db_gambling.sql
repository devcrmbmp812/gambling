-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2016 at 08:19 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_gambling`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblAds`
--

CREATE TABLE IF NOT EXISTS `tblAds` (
`id` int(11) unsigned NOT NULL,
  `adsImage` varchar(255) NOT NULL,
  `adsLink` text,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblBonusCards`
--

CREATE TABLE IF NOT EXISTS `tblBonusCards` (
`id` int(11) unsigned NOT NULL,
  `joinCode` int(11) unsigned NOT NULL,
  `sportsName` varchar(255) NOT NULL,
  `bonusName` varchar(255) NOT NULL,
  `bonusCode` varchar(255) NOT NULL,
  `bonustype` varchar(255) NOT NULL,
  `bonusAmount` varchar(255) NOT NULL,
  `description` text,
  `wageringRequirements` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `bonusImage` text,
  `rating` int(11) NOT NULL DEFAULT '3',
  `bonusOtherDetails` varchar(255) NOT NULL,
  `isPopular` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblBonusCards`
--

INSERT INTO `tblBonusCards` (`id`, `joinCode`, `sportsName`, `bonusName`, `bonusCode`, `bonustype`, `bonusAmount`, `description`, `wageringRequirements`, `link`, `imageName`, `bonusImage`, `rating`, `bonusOtherDetails`, `isPopular`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 69696, 'Sadari Sports', 'pinacle', 'ASOP67TY', 'Welcome Bonus', '200%', 'This is test for a welcome bonusThis is test for a welcome bonus', '23x', 'www.google.com', 'royal_casino.jpg', 'http://localhost/_gambling/your-project/images/royal_casino.jpg', 3, '[{"dtlName":"Cashable","dtlValue":"Yes"},{"dtlName":"Maximum Bonus Amount","dtlValue":"150%"},{"dtlName":"Minimum Deposit","dtlValue":"$20"},{"dtlName":"Maximum Cashout","dtlValue":"$200"},{"dtlName":"Allowed Games","dtlValue":"Starburst Slot"}]', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 04:48:44'),
(2, 69696968, 'test casino', 'ask gambler', 'DEFG67', 'First Deposite Bonus', '200%', 'test free spintest free spintest free spintest free spin', '35X', 'www.google.com', 'get_casino.jpg', 'http://localhost/_gambling/your-project/images/get_casino.jpg', 3, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"},{"dtlName":"min prize","dtlValue":"80000"},{"dtlName":"Allowed Games","dtlValue":"sadari"},{"dtlName":"Maximum Bonus Amount","dtlValue":"150%"},{"dtlName":"Cashable","dtlValue":"Yes"}]', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 04:54:31'),
(3, 696964, 'royal casino', 'Ask gambler', 'ASOP67TY', 'Welcome Bonus', '200%', 'this is test bonus code this is test bonus code this is test bonus code ', '45x', 'www.google.com', 'sadari_sports.jpg', 'http://localhost/_gambling/your-project/images/sadari_sports.jpg', 1, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"},{"dtlName":"min prize","dtlValue":"80000"},{"dtlName":"Maximum Bonus Amount","dtlValue":"150%"},{"dtlName":"Cashable","dtlValue":"Yes"},{"dtlName":"name","dtlValue":"sadari"}]', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-18 04:56:03'),
(4, 12356, 'royal casino', 'pinacle', 'ASOP67TY', 'Rolling Bonus', '200%', 'this is test bonus code this is test bonus code ', '23x', 'www.google.com', 'royal_casino.gif', 'http://localhost/_gambling/your-project/images/royal_casino.gif', 2, '[{"dtlName":"min prize","dtlValue":"$20"}]', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 06:00:12'),
(6, 58964, 'royal casino', 'pinacle', 'ASOP67TY', 'Combo Bonus', '200%', 'this is test bonus code this is test bonus code this is test bonus code ', '23x', 'www.google.com', 'new_image.jpg', 'http://localhost/_gambling/your-project/images/new_image.jpg', 3, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"}]', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-18 06:30:23'),
(7, 69696, 'Sadari Sports', 'pinacle', 'ASOP67TY', 'Every Time Bonus', '200%', 'this is test bonus code this is test bonus code this is test bonus code this is test bonus code ', '35X', 'www.google.com', 'new_image.png', 'http://localhost/_gambling/your-project/images/new_image.png', 5, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"}]', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-18 06:31:27'),
(9, 696966, 'royal casino', 'pinacle', 'ASOP67TY', 'First Deposite Bonus', '200%', 'test free spintest free spintest free spintest free spin', '23x', 'www.google.com', 'new_sports5.png', 'http://localhost/_gambling/your-project/images/new_sports5.png', 1, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"}]', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 12:36:40'),
(11, 696964, 'Sadari Sports', 'pinnacle', 'ASOP67TY', 'Rolling Bonus', '200%', 'test for free spin test for free spin test for free spin test for free spin', '35X', 'www.google.com', 'bit_coin1.png', 'http://localhost/_gambling/your-project/images/bit_coin1.png', 4, '[{"dtlName":"min prize","dtlValue":"$20"}]', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-19 13:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblBonusComment`
--

CREATE TABLE IF NOT EXISTS `tblBonusComment` (
`id` int(11) unsigned NOT NULL,
  `bonusId` int(11) unsigned NOT NULL,
  `userId` varchar(255) NOT NULL,
  `gdComments` text,
  `badComments` text,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblBonusComment`
--

INSERT INTO `tblBonusComment` (`id`, `bonusId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 11, '3', 'lorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emet', 'lorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emet', 3, 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-31 13:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblNewsBlog`
--

CREATE TABLE IF NOT EXISTS `tblNewsBlog` (
`id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `newsDesc` text,
  `newsImage` text,
  `newsImageName` varchar(255) NOT NULL,
  `isNews` enum('B','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblNewsBlog`
--

INSERT INTO `tblNewsBlog` (`id`, `title`, `author`, `newsDesc`, `newsImage`, `newsImageName`, `isNews`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(3, 'Summer Cruise', 'Anirban', '<p>Ever fancied just packing up your stuff and getting away for the summer? When you play at <a class="internal-link casino-details" href="http://www.askgamblers.com/online-casinos/vegas-crest-casino-casino-review/" data-name="Vegas Crest Casino" data-url="/online-casinos/vegas-crest-casino-casino-review/" data-logo="/uploads/casino-logos/vegas-crest-casino-539ee4bc70a0f871478b4569.png" data-rating="5.63" data-visit-url="/visit/vegas-crest-casino-casino-casino-review">Vegas Crest Casino</a>&nbsp;over the next few weeks you could be doing just that with their <strong>Summer Cruise Giveaway</strong>.</p>\r\n<h2>Set sail on a Summer Cruise</h2>\r\n<p>With summer just around the corner the <a class="internal-link" href="http://www.askgamblers.com/online-casinos-p10">online casino</a>&nbsp;have decided to get you in the mood with their summer giveaway. You could be starting your summer holidays on a sunny cruise to the gorgeous Royal Caribbean. It&rsquo;s set to be an experience of a lifetime and one where memories will be made that will last forever.</p>\r\n<blockquote>Enjoy the ultimate summer cruise with a friend or loved one</blockquote>\r\n<p>If you&rsquo;re the lucky winner of this once in a lifetime opportunity you&rsquo;ll be setting sail for a total of 8 days and 7 nights on board for 2 people. The hardest part will be picking who you want to take with you! You&rsquo;ll set sail from Fort Lauderdale and visit Nassau, Bahamas &ndash; Charlottel Amalie, St. Thomas and Basseterre St. Kitts.</p>\r\n<h2>Earn as many entries as you can</h2>\r\n<p>To be in with a chance of winning you&rsquo;ll need to start earning entries into the draw and you&rsquo;ve got until June 20th to get as many as you can. Every time you fund your account you&rsquo;ll get rewarded with free tickets, the more you deposit the more entries you&rsquo;ll get. Here&rsquo;s how it works:<br />1. Deposit between &pound;10 and &pound;29.99 and you&rsquo;ll get 1 entry into the draw<br />2. Deposit between &pound;30 and &pound;59.99 and you&rsquo;ll get 3 entries<br />3. Deposit between &pound;60 and &pound;179.99 and you&rsquo;ll get 7 entries<br />4. Deposit between &pound;180 and &pound;299.99 and you&rsquo;ll get 10 entries<br />5. Deposit &pound;300 or more and you&rsquo;ll get a massive 20 entries<br />Each deposit you make makes a difference to your total entries, it just depends on how bad you want to win!</p>\r\n<h2>An unforgettable experience</h2>\r\n<p>If you&rsquo;re the lucky winner, you and one friend will be relaxing in the ultimate comfort. You&rsquo;ll have an Outside Stateroom for 2 with convenience and luxury and staff waiting on you hand and foot 24/7.</p>\r\n<blockquote>You&rsquo;ll be dazzled onboard with gorgeous views, world-class performers and awe-inspiring shows!</blockquote>\r\n<p>When it comes to dining, this of course is all part of the journey. You&rsquo;ll enjoy a complete luxury dining experience in the perfect ambience of the ship. There&rsquo;s activates to keep you going from a day at the pool, aqua aerobics, rock wall climbing and lots more. And if you want to keep fit you can benefit from state-of-the-art equipment, fitness class and more!<br />It all sounds like the perfect setting, we only wish we could enter ourselves! Head over to <a class="internal-link casino-details" href="http://www.askgamblers.com/visit/vegas-crest-casino-casino-casino-review" rel="nofollow" data-name="Vegas Crest Casino" data-url="/online-casinos/vegas-crest-casino-casino-review/" data-logo="/uploads/casino-logos/vegas-crest-casino-539ee4bc70a0f871478b4569.png" data-rating="5.63" data-visit-url="/visit/vegas-crest-casino-casino-casino-review">Vegas Crest Casino</a>&nbsp;today and start collecting those entries.</p>', 'http://localhost/_gambling/your-project/images/news/Summer_Cruise.jpg', 'Summer_Cruise.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 22:57:48'),
(4, 'Tickets to the semi-finals', 'Anirban', '<p>The most talked about sporting event of the year is just around the corner, the Euro 2016. And NetEnt have released their brand new game just in time for some great promotions. This week has been the perfect opportunity to get your hands on some free tickets. But don&rsquo;t worry if you missed it we&rsquo;ll go through it again in this recap. We&rsquo;ll also take a look at some of the newest online casinos and games that were added this week.</p>\r\n<h2>Catch up on some of the headlines this week</h2>\r\n<h3>2 Tickets to the semi-finals could be yours!</h3>\r\n<p>Play NetEnt&rsquo;s Football: Champions Cup Slot at VideoSlots Casino and you could win 2 tickets to the Euro 2016 semi-finals in Marseille. You&rsquo;ve got until the 10th June to wager at least &euro;10 on the game which will guarantee yourself entry into the prize draw. Full details can be found by reading our story <a class="internal-link" href="http://www.askgamblers.com/gambling-news/promotions/play-football-champions-cup-to-win-2-tickets-for-the-euro-2016-semi-finals/">Play Football: Champions Cup to win 2 tickets for the Euro 2016 semi-finals</a>.</p>\r\n<h3>It&rsquo;s your last day to grab a 50% reload bonus</h3>\r\n<p>All week NextCasino have been hosting their very own music festival. Playing tribute to some great slots with great soundtracks. Today marks the last day of the festival and an opportunity for you to claim a 50% reload bonus. Just read our story <a class="internal-link" href="http://www.askgamblers.com/gambling-news/promotions/enjoy-sweet-music-free-spins-and-bonuses-with-nextcasino-s-music-festival/">Enjoy sweet music, free spins and bonuses with the NextCasino&rsquo;s music festival for your bonus code</a>.</p>\r\n<h3>End your weekend with some free spins at Kaboo</h3>\r\n<p>It&rsquo;s the last day of the weekend but there&rsquo;s no need to be sad because there&rsquo;s still time for you to win some Super Spins at Kaboo Casino. Simply make a deposit of at least &euro;50 today and you&rsquo;ll get 1 entry into the prize draw. 100 players will be picked at random and you could win &euro;100 worth of spins! Our story <a class="internal-link" href="http://www.askgamblers.com/gambling-news/promotions/enjoy-a-weekend-filled-with-free-spins-and-super-spins-at-kaboo-casino/">Enjoy a weekend filled with free spins and super spins at Kaboo Casino</a>&nbsp;has all the details you need to get started.</p>\r\n<h2>Get to know our newest casinos</h2>\r\n<h3>Cool Play Casino</h3>\r\n<p>A multi-platform casino home to a huge range of games from the likes of NetEnt, Microgaming, Nyx Interactive, Genesis Gaming and Thunderkick. Play straight from your web browser or enjoy an assortment of mobile games with their state-of-the-art lobby. Keep up to speed with all the newest games in the industry and friendly support 24/7. <a class="internal-link casino-details" href="http://www.askgamblers.com/online-casinos/cool-play-casino-review/" data-name="Cool Play Casino" data-url="/online-casinos/cool-play-casino-review/" data-logo="/uploads/casino-logos/cool-play-casino-logo-573ee50d7528f7fde68b45ae.png" data-rating="7.13" data-visit-url="/visit/cool-play-casino-casino-review">Read our Cool Play Casino Review for more information</a>.</p>\r\n<h3>Kudos Casino</h3>\r\n<p>Here we have a Real Time Gaming Casino giving you three different ways to play, from your mobile, your browser or through their download client. Whichever way you choose to play you&rsquo;ll be greeted with plenty of games from videos slots to blackjack and video poker.&nbsp;<a class="internal-link casino-details" href="http://www.askgamblers.com/online-casinos/kudos-casino-review/" data-name="Kudos Casino" data-url="/online-casinos/kudos-casino-review/" data-logo="/uploads/casino-logos/kudos-casino-logo-5746c7007528f7698e8b45f5.png" data-rating="7.13" data-visit-url="/visit/kudos-casino-casino-review">Your welcome bonus can be found by reading our Kudos Casino Review.</a></p>\r\n<h2>Spin for free with our newest games</h2>\r\n<h3>Football: Champions Cup</h3>\r\n<p>NetEnt&rsquo;s newest game is a must try at the moment. The football themed slot with 20 paylines across 5 reels will have you scoring goals with wild symbols, scoring wilds and overlay wilds. Enter free spins and a bonus game to increase your chances of winning.&nbsp;<a class="internal-link" href="http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/">Try Football: Champions Cup Slot for free.</a></p>\r\n<p><a class="internal-link" href="http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/"><img style="width: 100%; max-width: 800px;" src="http://www.askgamblers.com/uploads/football-champins-cup-3-5742d9467528f7f8488b4567.png" alt="Football: Champions Cup" width="800" height="438" /></a></p>\r\n<h3>Alaskan Husky</h3>\r\n<p>This new game from Nyx Interactive boasts an impressive 100 paylines and of course is themed around the beautiful Alaskan Huskys. Land three or more scatters and you&rsquo;ll win 10 free spins with both expanding and random wilds.&nbsp;<a class="internal-link" href="http://www.askgamblers.com/video-slots/alaskan-husky-nyx-interactive-game-review/">Play Alaskan Husky for free before trying it for real.</a></p>\r\n<h3>Ultimate Dream Team</h3>\r\n<p>With stacked wilds you can become part of the dream team when you play this 25-lined slot from Push Gaming. Enjoy a dream team bonus feature and free spins as you head to the field to score some goals.&nbsp;<a class="internal-link" href="http://www.askgamblers.com/video-slots/ultimate-dream-team-push-gaming-game-review/" rel="nofollow">Use our links to play the Ultimate Dream Team Slot for free.</a></p>\r\n<p><a class="internal-link" href="http://www.askgamblers.com/video-slots/ultimate-dream-team-push-gaming-game-review/"><img style="width: 100%; max-width: 800px;" src="http://www.askgamblers.com/uploads/ultimate-dream-team-5748128a7528f770fd8b45ba.png" alt="Ultimate Dream Team" width="800" height="530" /></a></p>', 'http://localhost/_gambling/your-project/images/news/Tickets_to_the_semi-finals.jpg', 'Tickets_to_the_semi-finals.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 22:59:47'),
(5, 'The latest jackpot winner', 'Anirban', '<p><a class="internal-link casino-details" href="http://www.askgamblers.com/casino/bgo-casino-review-r4421" data-name="BGO Casino" data-url="/casino/bgo-casino-review-r4421" data-logo="/uploads/casino-logos/bgo-casino-logo-5372285070a0f8f6378b4567.png" data-rating="3.75" data-visit-url="/visit/bgo-casino-review-rv4421">BGO Casino</a>&nbsp;have their next big winner! 52ALM from Bedfordshire managed to take from the <a class="internal-link" href="http://www.askgamblers.com/online-casinos-p10">online casino</a>&nbsp;a life changing &pound;1.6 million playing one of Playtech&rsquo;s popular games, their <a class="internal-link" href="http://www.askgamblers.com/game/slots/gladiator-jackpot-g4231">Gladiator Jackpot Slot</a>. Just how does a win like this change your life?</p>\r\n<h2>The latest jackpot winner</h2>\r\n<p>It all happened from his mobile device. One lucky player at BGO Casino was spinning the reels of Gladiator Jackpot when the big moment happened. A moment that is sure to change the player&rsquo;s life forever. Off the back of a very modest &pound;6.25 bet from his iPhone, player 52ALM hit the jackpot and is now enjoying &pound;1.6 million in his bank account!</p>\r\n<blockquote>Those big wins can come wherever you are, you&rsquo;ve just got to play</blockquote>\r\n<p>Shortly after the win the player told the casino he was absolutely thrilled. He plans on buying his dream car, a nice house and sharing some of his windfall with those closest to him! We&rsquo;re sending him a huge congratulations from the entire AskGamblers team.&nbsp;<br />Now we think it&rsquo;s your turn to win big and to do that you need to be a member at BGO Casino. So if you&rsquo;ve yet to sign up there we&rsquo;ve got an incredible welcome package for you to enjoy. That means you&rsquo;ll get to play with more funds to try for those all-important big wins.</p>\r\n<h2>Triple your first deposit</h2>\r\n<p>All new players signing up to BGO Casino for the first time get to enjoy their welcome package. You&rsquo;ll be treated to a bonus not just on your first deposit, but on your first four deposits. And to make the package even more rewarding, you&rsquo;ll also get 20 free spins just for signing up.</p>\r\n<blockquote>Free spins with no deposit required followed by four welcome bonuses sounds like a pretty good deal!</blockquote>\r\n<p>You&rsquo;ll kick things off when you make your first deposit. The casino will match it with an impressive 200% welcome bonus and they&rsquo;ll also throw in 180 free spins on <a class="internal-link" href="http://www.askgamblers.com/software/netent">NetEnt</a>&rsquo;s popular <a class="internal-link" href="http://www.askgamblers.com/game/slots/starburst-g4022">Starburst Slot</a>. Here&rsquo;s how you get it:<br />1. Sign up to BGO Casino<br />2. Play your <a class="internal-link" href="http://www.askgamblers.com/bonus/free-spins/bgo-casino-no-deposit-20-free-spins-on-registration/">20 free spins</a>, no deposit needed<br />3. Visit the cashier and make your first deposit<br />4. Enjoy a&nbsp;<a class="internal-link" href="http://www.askgamblers.com/bonus/welcome/bgo-casino-200percent-up-to-gbp100/">200% welcome bonus up to &pound;100</a><br />5. Play 20 free spins on Starburst every day for the next 9 days<br />All the casino ask is that you make a minimum &pound;10 deposit and that you wager your bonus 35x before requesting a withdrawal.</p>\r\n<h2>The rest of your welcome package follows</h2>\r\n<p>When you&rsquo;re ready to move on to your next deposits the casino will be on hand to give out your bonuses. You&rsquo;ll need to make a minimum &pound;10 deposit for your second bonus and both your third and fourth bonus will require a &pound;30 deposit. Here&rsquo;s what you&rsquo;ll get:<br />1. Make your second deposit to enjoy a&nbsp;<a class="internal-link" href="http://www.askgamblers.com/bonus/2nd-deposit/bgo-casino-100percent-up-to-gbp500/">100% bonus up to &pound;500</a><br />2. Make your third deposit and you&rsquo;ll get another 100% bonus up to &pound;500<br />3. Finally when you make your fourth deposit you&rsquo;ll get to play with a 100% bonus up to &pound;400<br />Each bonus you receive will need to be wagered 35x and when you&rsquo;re playing with a bonus your bets must not exceed &pound;10 on any game.&nbsp;<br />Sign up to <a class="internal-link casino-details" href="http://www.askgamblers.com/visit/bgo-casino-review-rv4421" rel="nofollow" data-name="BGO Casino" data-url="/casino/bgo-casino-review-r4421" data-logo="/uploads/casino-logos/bgo-casino-logo-5372285070a0f8f6378b4567.png" data-rating="3.75" data-visit-url="/visit/bgo-casino-review-rv4421">BGO Casino</a>&nbsp;today.</p>', 'http://localhost/_gambling/your-project/images/news/The_latest_jackpot_winner.jpg', 'The_latest_jackpot_winner.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:01:56'),
(6, 'Euro 2016 Finals', 'Anirban', '<p><a class="internal-link casino-details" href="http://www.askgamblers.com/online-casinos/21-casino-review/" data-name="21 Casino" data-url="/online-casinos/21-casino-review/" data-logo="/uploads/casino-logos/wenty-ne-asino-2-55a374277528f724218b4575.png" data-rating="7.63" data-visit-url="/visit/21-casino-casino-review">21 Casino</a>&nbsp;are going one step further than other <a class="internal-link" href="http://www.askgamblers.com/online-casinos-p10">online casinos</a>. They&rsquo;re not just giving away one or two tickets to the Euro 2016, they&rsquo;re giving away 26 tickets. <strong>Including tickets to the final!</strong> There&rsquo;s a series of challenges you can complete to be in with a chance of winning and if you don&rsquo;t win first time round you can just try again!</p>\r\n<h2>Can you win tickets to the Euro 2016?</h2>\r\n<p>Over the course of the next few weeks 21 Casino are setting you a number of challenges. The winners of these challenges will win tickets to the Euro 2016, so if you want the tickets you need to listen up. The first challenge is almost over but there&rsquo;s still today and tomorrow to complete it.</p>\r\n<blockquote>Refer your friends and you could be watching Belgium vs. Italy</blockquote>\r\n<p>Simply refer as many friends as you can before the end of the day tomorrow and those tickets could be yours. You can ask them to use our links to get to the casino, the more friends you refer the higher your chances are of winning the tickets.</p>\r\n<h2>Spain VS. Turkey tickets</h2>\r\n<p>Next week, complete the 5-day challenge and you could win tickets to the Spain vs. Turkey match. Just log into the casino every day between the 30th May and 6th June. It&rsquo;s you, head to head against the casino all week. There&rsquo;ll be a 25% deposit bonus waiting along with free spins when you play <a class="internal-link" href="http://www.askgamblers.com/software/netent">NetEnt</a>&rsquo;s <a class="internal-link" href="http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/">Football: Champions Cup Slot</a>. And of course there&rsquo;s still those all-important tickets to win as well.</p>\r\n<p><a class="internal-link" href="http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/"><img style="width: 100%; max-width: 800px;" src="http://www.askgamblers.com/uploads/football-champins-cup-3-5742d9467528f7f8488b4567.png" alt="Football: Champions Cup" width="800" height="493" /></a></p>\r\n<h2>Switzerland VS. France</h2>\r\n<p>For these tickets you&rsquo;ll have to take part in the 48-hour social media challenge. You&rsquo;ll need to head to the casinos Facebook page and complete a challenge to be in with a chance of winning.</p>\r\n<h2>Euro 2016 Finals</h2>\r\n<p>Between the 8th of June and the 28th of June it&rsquo;s the big one. Tickets to the Euro 2016 final. All you have to do is collect as many loyalty points as you can. You&rsquo;ll have almost three weeks to gather as many points as you can and you can do that by playing your favourite games.</p>\r\n<blockquote>It&rsquo;s a race against your fellow players to accumulate the most points</blockquote>\r\n<p>Whichever player collects the most loyalty points by the end of June will win the tickets to the finals. You can check all the ways you can earn loyalty points over at the casino website.<br />Sign up to <a class="internal-link casino-details" href="http://www.askgamblers.com/visit/21-casino-casino-review" rel="nofollow" data-name="21 Casino" data-url="/online-casinos/21-casino-review/" data-logo="/uploads/casino-logos/wenty-ne-asino-2-55a374277528f724218b4575.png" data-rating="7.63" data-visit-url="/visit/21-casino-casino-review">21 Casino</a>&nbsp;and win your tickets today.</p>', 'http://localhost/_gambling/your-project/images/news/Euro_2016_Finals.jpg', 'Euro_2016_Finals.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:03:31'),
(7, 'A royal experience', 'Anirban', '<p>Check it out! We recently added another online casino to our directory. This time it&rsquo;s <a class="internal-link casino-details" href="http://www.askgamblers.com/online-casinos/royalio-casino-review/" data-name="Royalio Casino" data-url="/online-casinos/royalio-casino-review/" data-logo="/uploads/casino-logos/royalio-logo-573b00c07528f712198b45d3.png" data-rating="7.38" data-visit-url="/visit/royalio-casino-casino-review">Royalio Casino</a>, home to <strong>over 500+ games</strong> from <a class="internal-link" href="http://www.askgamblers.com/software/microgaming/games">Microgaming</a>, <strong>Rival</strong>, <strong>Cozy Games</strong> and <strong>iSoftBet.</strong> We&rsquo;ve taken a look around already and it certainly ticks all the boxes!</p>\r\n<h2>A royal experience</h2>\r\n<p>Whether its slots, table games or scratch games you&rsquo;ll have your pick of some of the best games in the industry at Royalio Casino. And playing is literally just a click away. So that the casino is literally compatible for everyone there&rsquo;s three ways in which you can play. Open the casino straight from your web browser, download the casino or play straight from their impressive <a class="internal-link" href="http://www.askgamblers.com/mobile-casinos">mobile casino</a>.</p>\r\n<blockquote>Convenience is certainly no object at Royalio Casino</blockquote>\r\n<p>Taking the casino with you wherever you are brings you complete freedom. So if it&rsquo;s from your mobile device you want to play you certainly won&rsquo;t be disappointed. Just download their app from your iOS, Android, Windows or Blackberry device, sign up and play an assortment of games where ever you are.</p>\r\n<h2>Stylish and Sleek</h2>\r\n<p>As with any new casino nowadays you&rsquo;d expect nothing less than quality and that&rsquo;s exactly what you&rsquo;ll get every time you play at Royalio Casino. Their easy to use and friendly interface lets you search for any game, saving you time going through games you just know you aren&rsquo;t going to play. Or if its variety you like then why not use their A-Z search function and work your way through their games seeing where lady luck will land.</p>\r\n<p>You can indulge in seamless gaming sessions around the clock and it doesn&rsquo;t matter whether you&rsquo;re a newbie or a pro you&rsquo;re guaranteed to find a game you like here.</p>\r\n<h2>Getting started is easy!</h2>\r\n<p>Once you&rsquo;re a member you&rsquo;ll instantly be able to start enjoying player benefits, bonuses and more. Signing up is easy and takes just a few moments, you can even use these links to get you to where you need to be.</p>\r\n<blockquote>Play with a 100% welcome bonus on your first two deposits</blockquote>\r\n<p>As you&rsquo;re a new player you&rsquo;ll get to try out the casino with a welcome bonus on your first two deposits. The casino will match your first and second deposit with a 100% bonus and did we mention you&rsquo;ll also get &pound;10 free just for signing up? Here&rsquo;s how you can get started today:</p>\r\n<ol>\r\n<li><a class="internal-link casino-details" href="http://www.askgamblers.com/visit/royalio-casino-casino-review" rel="nofollow" data-name="Royalio Casino" data-url="/online-casinos/royalio-casino-review/" data-logo="/uploads/casino-logos/royalio-logo-573b00c07528f712198b45d3.png" data-rating="7.38" data-visit-url="/visit/royalio-casino-casino-review">Sign up to Royalio Casino</a></li>\r\n<li>Enjoy a <a class="internal-link" href="http://www.askgamblers.com/bonus/no-deposit/royalio-casino-gbp10-free/">&pound;10 no deposit bonus</a></li>\r\n<li>Visit the cashier and make your first deposit (no bonus code required)</li>\r\n<li>Instantly start playing with a <a class="internal-link" href="http://www.askgamblers.com/bonus/welcome/royalio-casino-100percent-up-to-gbp500/">100% welcome bonus up to &pound;500</a></li>\r\n</ol>\r\n<p>A minimum &pound;10 deposit will trigger your bonus and all the casino ask is that you <strong>wager your bonus 30x</strong> before requesting a withdrawal. Then when you&rsquo;re ready to claim your second bonus just visit the cashier, make another deposit, &pound;10 or more and the casino will match it with another 100%!</p>\r\n<p>We&rsquo;ll leave the rest to you. Sign up to Royalio Casino today.</p>', 'http://localhost/_gambling/your-project/images/news/A_royal_experience.jpg', 'A_royal_experience.jpg', 'B', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:05:06'),
(8, 'Play Mr Greenâ€™s Exclusive New Slot', 'Anirban', '<p><a class="internal-link casino-details" href="http://www.askgamblers.com/casino/mr-green-casino-review-r4217" data-name="Mr Green Casino" data-url="/casino/mr-green-casino-review-r4217" data-logo="/uploads/casino-logos/mr-green-casino-logo-53e4ccc370a0f87e738b4572.png" data-rating="6.63" data-visit-url="/visit/mr-green-casino-review-rv4217">Mr Green Casino</a>&nbsp;are celebrating the exclusive release of their new slot&nbsp;<a class="internal-link" href="http://www.askgamblers.com/video-slots/peter-and-the-lost-boys-push-gaming-game-review/">Peter and the Lost Boys</a> by <strong>Push Gaming</strong> and you have a chance to win some truly fantastic cash prizes. Moreover, if you play another new game by the name of&nbsp;<a class="internal-link" href="http://www.askgamblers.com/video-slots/michael-jackson-king-of-pop-bally-game-review/">Michael Jackson: King of Pop</a> you might snag tickets to Cirque du Soleil&rsquo;s popular Michael Jacksons ONE show. To learn how to get one step closer to a share of &euro;20,000 in cash prizes and the Cirque du Soleil tickets, just keep reading.</p><h2>Play Mr Green&rsquo;s Exclusive New Slot</h2><p>The stunning&nbsp;<span class="internal-link">Peter and the Lost Boys slot</span> is out and Mr Green Casino would like to give out some amazing cash prizes as part of their celebration. If you&rsquo;re up for a trip to Neverland, then this promo is just the thing you need! Your time with Peter Pan and his buddies might even bring you closer to Captain Hook&rsquo;s incredible &euro;20,000 treasure trove.</p><p><a class="internal-link" href="http://www.askgamblers.com/video-slots/peter-and-the-lost-boys-push-gaming-game-review/"><img style="width: 100%; max-width: 800px; display: block; margin-left: auto; margin-right: auto;" src="http://www.askgamblers.com/uploads/peter-and-the-lost-boys-574542347528f74b878b45fd.png" alt="Peter and the Lost Boys Slot" width="800" height="515" /></a></p><h2>How to Win the Cash Drop Prizes</h2><p>The slot itself is exclusive to Mr Green and you have a special shot at the prizes at the <a class="internal-link" href="http://www.askgamblers.com/online-casinos-p10">online casino</a>. All you need to do is play a minimum of 20 spins on Peter and the Lost Boys and, if you&rsquo;re one of the 50 randomly selected Mr Green players, you&rsquo;ll have a chance to win anything from &euro;50 all the way up to an amazing &euro;5000.</p><blockquote>Play a minimum of 20 spins on Peter and the Lost Boys to win between &euro;50 and &euro;5000.</blockquote><p>The promo started on the 24th of May and it will last till the 30th of May, so make sure you don&rsquo;t waste another minute&mdash;go spin those reels and good luck!</p><h2>Michael Jackson Prize Draw</h2><p>Gather round, Michael Jackson fans! Mr Green has an incredible offer for you. <strong>Between the 25th of May and the 5th of June, 2016</strong> you might snag tickets to Las Vegas to see Cirque du Soleil&rsquo;s Michael Jacksons ONE show live. And here&rsquo;s how.</p><blockquote>Wager &euro;10 on the Michael Jackson: King of Pop slot and earn 1 entry ticket to the prize draw.</blockquote><p>For every &euro;10 you wager on the new game Michael Jackson: King of Pop during the promo period, you&rsquo;ll receive 1 entry ticket to the Mr Green Casino prize draw. If you happen to be the lucky winner, you&rsquo;ll receive 2x tickets for the Cirque du Soleil show, flights and accommodation at the Mandalay Bay Resort &amp; Casino in Las Vegas. So, Thriller-ites, fingers crossed!</p><p><a class="internal-link" href="http://www.askgamblers.com/video-slots/michael-jackson-king-of-pop-bally-game-review/"><img style="width: 100%; max-width: 800px; display: block; margin-left: auto; margin-right: auto;" src="http://www.askgamblers.com/uploads/michael-jackson-king-of-pop-5746a4887528f700968b458b.png" alt="Michael Jackson King of Pop" width="800" height="461" /></a></p><p><a class="internal-link casino-details" href="http://www.askgamblers.com/visit/mr-green-casino-review-rv4217" rel="nofollow" data-name="Mr Green Casino" data-url="/casino/mr-green-casino-review-r4217" data-logo="/uploads/casino-logos/mr-green-casino-logo-53e4ccc370a0f87e738b4572.png" data-rating="6.63" data-visit-url="/visit/mr-green-casino-review-rv4217">Join Mr Green Casino today</a>&nbsp;and good luck winning their incredible prizes!</p>', 'http://localhost/_gambling/your-project/images/news/play.jpg', 'Play_Mr_Greenâ€™s_Exclusive_New_Slot.jpg', 'B', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblNewsComment`
--

CREATE TABLE IF NOT EXISTS `tblNewsComment` (
`id` int(11) unsigned NOT NULL,
  `newsId` int(11) unsigned NOT NULL,
  `userId` varchar(255) NOT NULL,
  `gdComments` text,
  `badComments` text,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblSlider`
--

CREATE TABLE IF NOT EXISTS `tblSlider` (
  `id` int(11) unsigned NOT NULL,
  `sliderImage` varchar(255) NOT NULL,
  `sliderImageName` varchar(255) NOT NULL,
  `sliderHeading` varchar(255) NOT NULL,
  `sliderText` varchar(255) NOT NULL,
  `buttonOne` varchar(255) DEFAULT NULL,
  `buttonTwo` varchar(255) DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblSlider`
--

INSERT INTO `tblSlider` (`id`, `sliderImage`, `sliderImageName`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 'http://localhost/_gambling/your-project/images/slider/slider_01.png', 'slider_01.png', 'This is first slider', 'first test slider', 'read more+www.google.com+', NULL, '0000-00-00 00:00:00', 0, 0, '2016-05-24 20:16:04'),
(2, 'http://localhost/_gambling/your-project/images/slider/slider_02.png', 'slider_02.png', 'Play your Beloved Sports and get free Spin Daily', 'Sed ut perspiciatis unde omnis iste natus error sit accusantium dolore', 'read more+www.google.com+', NULL, '0000-00-00 00:00:00', 0, 0, '2016-05-24 20:20:14'),
(3, 'http://localhost/_gambling/your-project/images/slider/slider_03.png', 'slider_03.png', 'Play your Beloved Sports and get free Spin Daily', 'Sed ut perspiciatis unde omnis iste natus\r\nerror sit accusantium dolore', 'read more+www.google.com+', NULL, '0000-00-00 00:00:00', 0, 0, '2016-05-24 20:21:03'),
(4, 'http://localhost/_gambling/your-project/images/slider/slider_04.png', 'slider_04.png', 'Play your Beloved Sports and get free Spin Daily', 'asfafdfd', '++', NULL, '0000-00-00 00:00:00', 0, 0, '2016-05-24 20:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `tblSportsComment`
--

CREATE TABLE IF NOT EXISTS `tblSportsComment` (
`id` int(11) unsigned NOT NULL,
  `sportsId` int(11) unsigned NOT NULL,
  `userId` varchar(255) NOT NULL,
  `gdComments` text,
  `badComments` text,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblSportsComment`
--

INSERT INTO `tblSportsComment` (`id`, `sportsId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(2, 14, '3', 'i like this website', 'i dont like this website', 3, 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-31 04:25:26'),
(3, 13, '3', 'love this sports', 'this sports does not have free spin bonus', 3, 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-31 04:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE IF NOT EXISTS `tblUser` (
`id` int(11) unsigned NOT NULL,
  `parentId` int(11) unsigned NOT NULL DEFAULT '0',
  `userId` varchar(150) NOT NULL,
  `nickName` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `groupId` int(11) unsigned NOT NULL DEFAULT '3' COMMENT '`tblUserGroup`->`id`',
  `siteName` varchar(150),
  `createdOn` datetime NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the modifier of user',
  `isActive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `isDelete` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_tblUser_siteName` (`siteName`)
);

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`id`, `parentId`, `userId`, `nickName`, `email`, `password`, `groupId`, `createdOn`, `updatedOn`, `createdBy`, `updatedBy`, `isActive`, `isDelete`) VALUES
(1, 0, 'vip123', 'Ani', 'admin@gambler.com', 'test123', 0, '2016-05-24 17:50:12', '2016-05-27 04:51:31', 0, 0, 'Y', 'N'),
(3, 0, 'dpi90', 'test', 'ani120812@gmail.com', 'test123', 3, '0000-00-00 00:00:00', '2016-05-27 04:11:15', 0, 0, 'Y', 'N'),
(22, 0, 'vbb89', 'test123', 'admin@test.com', 'test123', 3, '0000-00-00 00:00:00', '2016-05-27 04:11:27', 0, 0, 'Y', 'N'),
(23, 0, '', '', '', '', 3, '0000-00-00 00:00:00', '2016-05-27 10:27:47', 0, 0, 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserAccess`
--

CREATE TABLE IF NOT EXISTS `tblUserAccess` (
  `id` int(11) unsigned NOT NULL COMMENT '`tblUser`->`id`',
  `role` text NOT NULL,
  `modifiedBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id',
  `updateOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblUserDetails`
--

CREATE TABLE IF NOT EXISTS `tblUserDetails` (
  `id` int(11) unsigned NOT NULL COMMENT '`tblUser`->`id`',
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `gender` enum('M','F','T') NOT NULL DEFAULT 'M' COMMENT 'M = Male, F = Female, T = Transgender/Other',
  `dob` date DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `settings` text,
  `zipCodeId` int(11) NOT NULL COMMENT '`tblZipCode`->`id`',
  `cityId` int(11) NOT NULL COMMENT '`tblCity`->`id`',
  `stateId` int(11) NOT NULL COMMENT '`tblState`->`id`',
  `countryId` int(11) NOT NULL COMMENT '`tblCountries`->`id`',
  `mobileNo` varchar(20) DEFAULT NULL,
  `landlineNo` varchar(20) DEFAULT NULL,
  `alternateNo` varchar(20) DEFAULT NULL,
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblUserDetails`
--

INSERT INTO `tblUserDetails` (`id`, `firstName`, `lastName`, `designation`, `gender`, `dob`, `address`, `settings`, `zipCodeId`, `cityId`, `stateId`, `countryId`, `mobileNo`, `landlineNo`, `alternateNo`, `updatedBy`, `updatedOn`) VALUES
(1, 'Anirban', 'Paul', 'Administrator', 'M', '1993-03-29', '1/10, East Boalia, Garia Sation', NULL, 1, 1, 1, 99, '+919830344377', '', '', 0, '2016-05-24 12:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserGroup`
--

CREATE TABLE IF NOT EXISTS `tblUserGroup` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `role` text NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updateOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblUserGroup`
--

INSERT INTO `tblUserGroup` (`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES
(1, 'Administrator', '{}', 0, '2016-05-24 12:20:12'),
(2, 'Site Admin', '{}', 0, '2016-05-24 12:20:12'),
(3, 'User', '{}', 0, '2016-05-24 12:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblWebCards`
--

CREATE TABLE IF NOT EXISTS `tblWebCards` (
`id` int(11) unsigned NOT NULL,
  `joinCode` int(11) unsigned NOT NULL,
  `siteName` varchar(255) NOT NULL,
  `sportsName` varchar(255) NOT NULL,
  `bonusCode` varchar(255) NOT NULL,
  `sportsType` varchar(255) NOT NULL,
  `bonusAmount` varchar(255) NOT NULL,
  `description` text,
  `wageringRequirements` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `maxPrizeMoney` varchar(255) NOT NULL,
  `singleBet` varchar(255) NOT NULL,
  `crossBetting` varchar(255) NOT NULL,
  `welcomeBonus` varchar(255) NOT NULL,
  `miniGame` varchar(255) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `sportsImage` text,
  `rating` int(11) NOT NULL DEFAULT '3',
  `sportsOtherDetails` varchar(255) NOT NULL,
  `isRecommanded` enum('Y','N') NOT NULL DEFAULT 'N',
  `isHot` enum('H','N') NOT NULL DEFAULT 'H',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sportsReview` text
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblWebCards`
--

INSERT INTO `tblWebCards` (`id`, `joinCode`, `siteName`, `sportsName`, `bonusCode`, `sportsType`, `bonusAmount`, `description`, `wageringRequirements`, `link`, `maxPrizeMoney`, `singleBet`, `crossBetting`, `welcomeBonus`, `miniGame`, `imageName`, `sportsImage`, `rating`, `sportsOtherDetails`, `isRecommanded`, `isHot`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`, `sportsReview`) VALUES
(1, 69696, 'test casino', 'Sadari Sports', 'ASOP67TY', 'Online Sport', '200%', 'online sports test online sports testonline sports testonline sports testonline sports test', '35X', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'online_sports1.jpg', 'images/online_sports1.jpg', 1, '', 'N', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-17 18:01:09', NULL),
(2, 69696968, ' name royal casino', 'Sadari Sports', '12354', 'Online Sport', '200%', 'online sports testonline sports testonline sports test', '35X', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'online_sports2.png', 'images/online_sports2.png', 4, '', 'Y', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-17 18:02:52', NULL),
(4, 69696, 'royal casino', 'Sadari Sports', 'ASOP67TY', 'Newest Sport', '200%', 'online sports testonline sports test', '23x', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'get_casino.png', 'images/get_casino.png', 2, '', 'N', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-18 01:43:16', NULL),
(5, 69696, 'royal casino', 'Sadari Sports', 'ASOP67TY', 'Newest Sport', '200%', 'online sports testonline sports testonline sports test', '35X', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'get_casino.jpg', 'images/get_casino.jpg', 3, '', 'N', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 01:44:19', NULL),
(7, 69696456, 'royal casino', 'Sadari Sports', 'ASOP67TY', 'Verified Sport', '200%', 'test description verfied sportstest description verfied sports', '35X', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'new_sports6.png', 'images/new_sports6.png', 5, '', 'Y', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-18 08:33:22', NULL),
(8, 69696, 'test casino', 'Sadari Sports', 'ASOP67TY', 'Verified Sport', '200%', 'lorem ipsum dollar set emet', '35X', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'free_spin.png', 'images/free_spin.png', 4, '', 'Y', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-19 06:19:03', NULL),
(11, 456987, 'royal casino', 'Sadari Sports', 'ASOP67TY', 'Bitcoin sport', '200%', 'test for bit coin', '23x', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'bit_coin.png', 'images/bit_coin.png', 4, '', 'Y', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-19 07:43:08', NULL),
(12, 69696, 'royal casino', 'Sadari Sports', 'ASOP67TY', 'Verified sport', '200%', 'test for verified sports test for verified sports', '45x', 'www.google.com', '8000000', '50%', 'Allow', '10%', 'Power ball', 'verified_sports.png', 'images/verified_sports.png', 5, '', 'Y', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-19 07:54:36', NULL),
(13, 69696, 'royal casino', 'Sadari Sports', 'n/a', 'Verified sport', 'n/a', 'test test test testtest testtest testtest testtest testtest testtest testtest test', 'n/a', 'www.google.com', '500ë§Œì›', 'ìž…ê¸ˆì•¡ì˜ 50%', 'ê°€ëŠ¥', '10%', 'Power ball', 'test_image.png', 'images/test_image.png', 3, '[{"dtlName":"max prize money","dtlValue":"80,00,000,000"},{"dtlName":"min prize","dtlValue":"80000"},{"dtlName":"Allowed Games","dtlValue":"sadari"},{"dtlName":"Maximum Bonus Amount","dtlValue":"150%"},{"dtlName":"Cashable","dtlValue":"Yes"}]', 'Y', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-19 08:29:06', NULL),
(14, 69696, 'crystal Casino', 'sportsname', '', 'Mobile sport', '200%', 'this is just a dummy description for mobile sports', '', 'www.google.com', '50000000', '10%', '50%', '10%', 'pinball', 'mobile_sports.jpg', 'http://localhost/_gambling/your-project/images/mobile_sports.jpg', 4, '', 'N', 'H', '0000-00-00 00:00:00', 0, 0, '2016-05-30 22:32:33', '"\r\n\r\ntest test test tsedy</p>"');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblAds`
--
ALTER TABLE `tblAds`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblBonusCards`
--
ALTER TABLE `tblBonusCards`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_tblBonusCards_imageName` (`imageName`);

--
-- Indexes for table `tblBonusComment`
--
ALTER TABLE `tblBonusComment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblNewsBlog`
--
ALTER TABLE `tblNewsBlog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblNewsComment`
--
ALTER TABLE `tblNewsComment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblSlider`
--
ALTER TABLE `tblSlider`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_tblSlider_sliderImageName` (`sliderImageName`);

--
-- Indexes for table `tblSportsComment`
--
ALTER TABLE `tblSportsComment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_tblUser_email` (`email`), ADD UNIQUE KEY `UK_tblUser_userId` (`userId`), ADD KEY `IDX_tblUser_parentId` (`parentId`);

--
-- Indexes for table `tblUserAccess`
--
ALTER TABLE `tblUserAccess`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUserDetails`
--
ALTER TABLE `tblUserDetails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUserGroup`
--
ALTER TABLE `tblUserGroup`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_tblUserGroup_title` (`title`);

--
-- Indexes for table `tblWebCards`
--
ALTER TABLE `tblWebCards`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `UK_tblWebCards_imageName` (`imageName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblAds`
--
ALTER TABLE `tblAds`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblBonusCards`
--
ALTER TABLE `tblBonusCards`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblBonusComment`
--
ALTER TABLE `tblBonusComment`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblNewsBlog`
--
ALTER TABLE `tblNewsBlog`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tblNewsComment`
--
ALTER TABLE `tblNewsComment`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblSportsComment`
--
ALTER TABLE `tblSportsComment`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tblUserGroup`
--
ALTER TABLE `tblUserGroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblWebCards`
--
ALTER TABLE `tblWebCards`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SELECT 'CREATE `tblComplaints`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblComplaints`;
CREATE TABLE IF NOT EXISTS `tblComplaints` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) NOT NULL,
  `siteName` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `complaintTitle` text NOT NULL,
  `complaintText` text NOT NULL,
  `complaintFiles` text,
  `onSiteAccountName` varchar(255) NOT NULL,
  `onSiteEmail` varchar(255) NOT NULL,
  `isVerified` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` enum('P','S','U') NOT NULL DEFAULT 'P',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

SELECT 'CREATE `tblComplaintsResponse`' AS 'TABLE OPERATIONS';
DROP TABLE IF EXISTS `tblComplaintsResponse`;
CREATE TABLE IF NOT EXISTS `tblComplaintsResponse` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `complaintId` int(11) unsigned NOT NULL,
  `userId` varchar(255) NOT NULL,
  `siteName` varchar(255) NOT NULL,
  `responsText` text NOT NULL,
  `responsFiles` text,
  `isVerified` enum('Y','N') NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) unsigned NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);
