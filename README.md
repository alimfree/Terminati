#Terminati
===============

Terminati is a simple tool to ease the manual archival upload process at Brafton. 
[Check out Terminati online](http://tech.contentlead.com/terminati)

Started 5-18-2014
Completed 5-22-2014 

##Purpose
Automated content imports may fail for various reasons. Currently, there's no quick process in 
place to verify Brafton clients successfully receive content. Terminati is the first part of a 
two step process designed to solve this problem.  

##How it works
Provided a list of article id's, Terminati cross checks against a given xml archives file to 
find missing articles. 

If a value for Articles/File is provided, Terminati will also chop a large xml file into 
several smaller files each containing the specified number of articles or less. Alternatively, 
if a value is not provided or the number of Articles/File is less than the generated file's 
article count Terminati returns a zip file containing a single xml file.

Before using this service to scan for missing content, you first need to query the client's
database and retrieve a list of id's for all successfully imported content. 

For any additional questions. Please reach out to techsupport@brafton.com

##Credits: 
http://davidwalsh.name/create-zip-php

http://truelogic.org/wordpress/2012/07/03/split-large-xml-into-parts-before-processing-in-php/




