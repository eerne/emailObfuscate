--------------------
emailObfuscate
--------------------
Version: 1.0.0
Authors:
- Aloysius Lim
- Enrique Erne
--------------------

emailObfuscate output modifier for MODx
Version: 1.0.0

based on ObfuscateEmail plugin 0.9.1 (Apr 15, 2007) by Aloysius Lim, released under Public Domain.
http://modxcms.com/extras/package/?package=322

This modifier searches for all email addresses and "mailto:" strings in the
input, both inside and outside href attributes. In other words, it also
encodes link text.

It can find all common email addresses as specified by RFC2822, including all
unusual but allowed characters. Any email addresses that satisfy the
the construct below will be detected:

The plugin than randomly leaves 10% of the characters alone, encodes 45% of
them in decimal, and 45% of them in hexadecimal.

Output modifier example:

[[*myTv:emailObfuscate]] or [[$myChunk:emailObfuscate]]

Snippet example:

[[!emailObfuscate? 
  &input=`<a href="mailto:info@mydomain.com">info@mydomain.com</a>`
]]

