## Background

Amada Senior Care was started in 2007 and started franchising a couple years later.  When they began to franchise, they 
were in need of a complete revamp of their online presence.  The owners approached me to redo their web portal and frontend 
site.

## Wordpress

The Amada Senior Care site consists of a Multi-site Wordpress with 2 child themes based on the Avada Theme from ThemeForest.
I branched the site onto 3 Amazon EC2 instances.

- One for the Corporate Site and blog (https://www.amadaseniorcare.com)
- One for the Franchise Site and blog (https://www.amadaseniorcare.com/franchise)
- One as a cloner for each locations site and blog (https://www.amadaseniorcare.com/kansas-city-senior-care/, https://www.amadaseniorcare.com/omaha-senior-care/, + >150 more)

When a new territory was purchased, the web team could use NSCloner to clone the Location Template into a new site.  When 
cloning, they would enter placeholder fields such as `%location%` and `%owner%`.  These placeholders would be replaced 
into the template and the new territory's site would be live within a few minutes.

## Legacy Process

Before I came onboard, each territory site was created by hand from an old template.  If anything on the template needed 
to be changed, each territory site needed to be updated by hand.  This was very time-consuming for small changes such as 
adding a territory map, changing the site favicon, or adding meta keywords for SEO.

## SEO

By combining all the sites and using WP Child Themes, the company was able to leverage Yoast SEO and other Wordpress plugins
across all the sites.  Each territory received it's own domain, which redirected to a sub-folder of the main site.  This 
allowed the SEO ranking to grow for each individual territory while utitilizing back links to the main site.  

## Timeline
This entire process was performed by myself with the oversight of the Marketing VP at the time.  The changeover took about 
six months to perform.