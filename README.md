Disclaimer: This is still a work in progress
============================================

I've found myself doing a number of WordPress themes that have been mobile-enabled, so I wanted to pull together a basic collection of boilerplate code that can be used to quickly pull together a mobile theme. This set of files uses the latest [jQuery Mobile](http://jquerymobile.com/test/) library, marks up the output with the classes and data attributes to take advantage of jQuery Mobile's API and allows a framework to define basic gestures for navigation (in this example: swiperight = back).

Please don't consider this a final theme to use. It should serve as a demonstration of some of the capabilities of jQuery Mobile as applied to WordPress, and provide the basic semantic structure for a jQm-powered theme. Feel free to use this as a starting point for your projects. Feedback and pull requests are welcomed.

Todos (glaringly unfinished)
----------------------------

- Reply to comments link is not active yet... I've roughed in the split-list markup to test the UI but haven't added any of the necessary js yet.
- I'm working on adding Matt Wilcox's [Adaptive Images](https://github.com/MattWilcox/Adaptive-Images) script, but haven't actually worked it in yet.
- Obviously, there's no styling added yet.
