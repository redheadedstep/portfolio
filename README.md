## Portfolio

As a Full Stack Developer with extensive experience, there are a lot of projects that I have worked on.  Most of these
projects were done completely by myself or I lead the team as the project architect. I have the mindset that in order
to be a great developer, you can't limit yourself.  If your project requires javascript, you learn javascript.  If your
project requires graphics, you learn how to use a graphic editor.  If your project requires SSL on a remote server with
frontend caching, then you learn how to generate a CSR, load Apache and install Linux.

## Mojavi Framework

The Mojavi Framework was originally designed when PHP 5.0 was first released.  It was a PHP port of the then popular
Java Struts Framework (which was later acquired by the Apache Foundation and is now [Apache Struts 2](https://struts.apache.org)).  It is a very
lightweight MVC framework that supports abstracted database connection pooling, requests, controllers, and views.

It was missing several components that I have added over time such as:
- Logging
- Models
- Forms
- MongoDB Support
- Database Result Resources
- CLI Controllers
- Updated Autoloader (for Composer support)
- REST Controllers

The Mojavi Framework has been discontinued by the original author, but was forked into the [Agavi Framework](http://www.agavi.org) that is
maintained by BitExtender.  I have also released my fork of the Mojavi Framework to
[GitHub](https://github.com/hiveclick/mojavi) and [Composer](https://packagist.org/packages/hiveclick/mojavi).

## RAD

The RAD Mailing Platform was designed by myself back in 2008 as a mass mailing platform.  It can be deployed to a
centralized API/Admin server and can have dozens of mailers communicating with it.  Each mailer is capable of downloading
data lists, rotating available IPs, and harvesting bounce and deliverable files.  The platform is fully automated and
can handle millions of IP addresses and billions of pieces of mail.

I licensed the RAD Mailing Platform to dozens of clients over time and have helped them fine tune their mailing
practices.  This required knowledge of IP binding (CIDR, Subnets, Broadcast), GRE Tunneling (TCP Headers, ARP, MTU),
Domain Authentication (DKIM, SPF, DMARC), SMTP Protocols, Low Level Socket handling, Spam Filters (and how to get around
them), and Email Creation (HTML/Plain Text, embedded images, Code hacks, etc).

## Pteradata

The Pteradata Platform was developed to facilitate the intake and distribution of millions of data records.  As sites
received email optins and other personal information, it became apparent that there was a need to save this information
into a centralized database and offer the data to publishers.  The data would have to be imported via an HTTP GET/POST or
a file import (either local or remote ftp).  The data needed to be scrubbed against existing black lists and banned words/ips.

Finally, the data needed to be posted to remote servers and formatted for each individual recipient.  Some people wanted
the dates as european, some wanted them as ISO standard.  Some people wanted the first and last names broken up.  Others
just had a simple name field.

## Flux

This was an internal project used to track incoming data and send it out for fulfillment.  Much like Pteradata, the data
was stored in MongoDB and could be formatted for each recipient.  Beyond that, however, the system had to allow for any
arbitrary data to be stored.  If a landing page asked how many pets you owned, that data had to be stored.  If you had a
choice between five maladies, we had to store that data as well.

Flux had several utilities as well that enabled it to generate 1000s of backlinks for SEO, download Google Adwords budgets
using OAuth, and integrating with Mailchimp for confirmation emails.

## BuxBux

BuxBux is a coupon and affiliate commission site that passes commissions on to the consumer.  It is modeled after other
coupon sites such as [Swagbucks](http://www.swagbucks.com) and [Retail-Me-Not](http://www.retailmenot.com).  BuxBux
integrates with several aggregate feeds.  It also allows for backlinks to be created to improve SEO, but it does this
using the affiliate links.

BuxBux also has a public facing web site where consumers can search and shop for coupons and products.  They can create
a personal account (and link it with their Facebook account).  From there, they can track their commissions and payments.