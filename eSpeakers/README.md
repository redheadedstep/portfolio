## Background

eSpeakers is the largest directory for motivational speakers in the world.  The company offers a suite of online tools 
for the speaking professional as well as an online marketplace of jobs.  Additionally, eSpeakers licenses their technology 
to hundreds of speaking bureaus and directories such as the National Speakers Association and Global Speakers Federation.

Finally, the suite of online tools are whitelabeled to several companies that specialize in educational training 
(Professional Development) for schools across the nation.

## Role

As the systems architect and lead developer, I have the responsiblity to design, maintain, and implement all the sites, tools,
procedures, and systems in the company.  In the past few years, I have developed and implemented several enterprise solutions
for the company.  Among them are:

- Setup production Oracle and MySQL databases with regular backup and restore scripts
- Migrated from a single Rackspace server to AWS with load balancers, proxy servers, and IAM authentication
- Maintained the Google Play app (Java) and Apple App Store app (Swift) along with the universal mobile app (React-Native)
- Migrated the mobile apps from Cordova to Ionic
- Built an online marketplace (Next.JS) for thousands of speaking jobs that included professional speaker profiles, video reviews, payment via Stripe, and document signing.
- Built the entire backend company tools (Symfony+ReactJS) to be used by eSpeakers and all Whitelabels
- Built the frontend user experience for >35,000 users to manage their profile, bio, videos, reviews, and memberships.
- Integrated with dozens of backend systems such as Salesforce, Zoho, Stripe, Docusign, Trello, Google, Facebook, and LinkedIn
- Setup CI/CD using AWS CodePipeline with deploys to Elastic Beanstalk environments
- Setup deployment scripts for firewalls, API servers, frontend Amplify environments, and SPAs

## Legacy Process

Before I came onboard, the entire site ran on a single server at Rackspace that was maxed out on load most days.  The codebase 
was written in PHP 4 and had several security holes.  The company managed all it's subscriptions on WHMCS (via a local MySQL database)
and held credit card information in plain text.  

## SEO

I migrated the Marketplace application to NextJS (from React10) to aid in SEO ranking.  The entire frontend was deployed on 
AWS Amplify and registered 99+ on the Lighthouse score for all 4 categories.

