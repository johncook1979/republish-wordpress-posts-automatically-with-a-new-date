# Republish old WordPress posts automatically with a new date
How to programmatically republish old WordPress posts automatically with a new published date.
This snippet will allow you to push old content to the front page of your website on autopilot. Simply paste the code into the functions.php file of your child theme, define the cron schedule and sit back and wait for the posts to begin their rebirth.

### How does this snippet work

1. We define a cron schedule. In the code provided here it is set to run every 12 hours, but you can change that to any value you desire in seconds. 
2. We create an array of all posts by looping through a new WP query
3. The array of posts is shuffled reorganising the order of posts in the array
4. The first index [0] is selected and the post is updated with the current time and date

In the WP query you can set it to specific ccategories or tags or even post types. The choice is yours. You can additionally alter the cron frequency by randomising the frequency (not recommended). eg. rand(43200, 86400);

I'm not an SEO expert, so I can not say what this will do to your search rankings, but it will certainly push old content to the front page of your website.

