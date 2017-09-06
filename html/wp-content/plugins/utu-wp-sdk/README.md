# wp-sdk
uTu web SDK packaged into Wordpress plugin.  Following is a breakdown of all the pieces of the plugin.

# Meta-box.php
This file is important and will need to be frequently updated.  What it does is add a "meta-box" to a
post page.  Whatever is added here will be stored as meta data for the post.  As written, this adds a
single new field call "event".  It will show up as a section near the bottom of the post and be populated
as "uTu Event".

Whatever this "event" is on the page will show up as the custom "event" name within the uTu console.  So,
for example from jobs.mydomain.com any job postings may be grouped with the event "Job Posting" or "Viewed Job Posting".

# Page.php
This does universal code insertion across all your WP pages.  Out of the gates it does two things:

## Page Tracking
Similar to google analytics:
```php
echo
  "<script type='text/javascript'>
      utu.track(\"$event_label\", {
        'Post Name': \"$my_title\",
        'Page Url': window.location.pathname,
      });
  </script>";
```
This takes the label, defined per page, and the title and path of the file and logs it.

## Click Tracking
As is, this needs to be modified to each persons instance.  What it looks for is an instance of a clickable element
that has the class "trackCTA" attached to it.  When thats clicked it will log an event "wp > site".  Again, this is
just filler.  You could customize and add as many custom events as you'd like using this pattern.

```js
var ctaClicks = window.document.getElementsByClassName("trackCTA");
[].forEach.call(ctaClicks, function (cta) {
  cta.addEventListener("click", function(event) {
    utu.track('wp > site', {});
  });
});
```

# utu-wp-js.php
This handles loading the utu library and initializing it.  The utu.init function not only starts up utu, but also
tags the current user.

## getParameterByName
is a useful function for passing in key values on the inbound request string and then writing them to a user or event.
For example, htttps://www.utu.ai/?ls=CoolSite here we may want to tag inbound links from partner sites - in this case
"CoolSite" and track that.  Could be used for any type of UTM parameter tags.

```js
utu.identity({
  custom: {
    leadSource: ls || 'organic'
  }
});
```

# utu.php
This page is the plugin admin page.  Not much if any customization to do here.  Important to note that a user of the plugin
needs to go to this settings page to enter their uTu token.
