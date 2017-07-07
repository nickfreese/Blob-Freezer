#BLOB FREEZER# - COPYRIGHT Nick Freese 2017 -
------------------------------------------------------------------------------------------------------------------

##what##:  Blob Freezer is a nifty piece of web software which aids image performance optimization.  it combines dynamic image optimization, image blobs, sprite sheets and aggressive caching to deliver faster page loads and 

------------------------------------------------------------------------------------------------------------------

##How##:  blob freezer allows you to bundle groups of images which will all be used together turns them to plain text, and sends them back in a single request response.  This response is then cached to ensure speedy responses after the forst for anygiven group.

Blob Freezer also checks for webp support, if it exists, it will convert your images to webp, save them, and cache their plain text response as well.  Currently Webp is only supported in chrome but Chrome take oup the majoirty of the browser market. See: https://www.w3schools.com/Browsers/default.asp

------------------------------------------------------------------------------------------------------------------

##Why##: Page speed performance is widely considered to be a very important part of keeping users on your site.  a lot of best practicescan be very time consuming and difficult for a small team or website to maintain.  Blob Freezer helps you optimize file format and acts as a spriting sytem for reducing requests.  Blob Freezer combines these concepts in the easiest possible way.

------------------------------------------------------------------------------------------------------------------

##When##:  The future looks bright for Blob Freezer. here is a quick list of planned additions.

- Dynamic sizing optimization
    - size by request per image.
    - size by max width requested.
    - auto size and format by device width and type.
 
- Support for sub folders
- resource includes.  including css and content.  options for minification.
- routing gui. allows site content structure to be defined for web app requests
- 


------------------------------------------------------------------------------------------------------------------

##Usage##:

in the public folder, add a folder with the images you would like in a request.
Add the folder's name to the 'registry' array in config.php

The request format looks like the following <your domain>/<path/to/blob-freezer>/folder/<foldername>

example: nickfreese.com/blob-freezer-example/folder/images

