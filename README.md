# nasumilu/ux-leafletjs

This is a Symfony UX -> lealfet.js integration component.


## Install

During development install using composer is only possible if you add the git
repository. Upon the first release a packagis and flex recipe will easy the pain
of installing this component. Until then this is the process required:

```json
{
    "repositories" [
        {
            "type": "vcs",
            "url": "https://github.com/nasumilu/ux-leafletjs"
        }
    ]
}
```

```sh
composer require nasuilu/ux-leafletjs:dev-main
```