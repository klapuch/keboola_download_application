# keboola_download_application

It downloads remote CSV authenticated files.

Usage
-----

`Keboola config file`

```
{
    "url": "http://remote.file.cz",
    "username": "harry",
    "password": "secret",
    "old_delimiter": ";",
    "new_delimiter": ","
}
```

`username`, `password`, `old_delimiter` and `new_delimiter` are optional. Delimiters are `,`(comma) by default.
