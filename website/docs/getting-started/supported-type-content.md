---
sidebar_position: 2
---

# Supported Type Content

1. Text
   
Support text type value content.

##### JSON example output

```
{
    "text-exmaple" : {
        "name" : "text-example",
        "label" : "Text Example",
        "type" : "text",
        "data" : "Lorem ibsum siamet dor..."
    }
}
```

2. Image
   
Support image type value content, image your choice for value content automatic save `storage/app` in laravel project.

##### JSON example output

```
{
    "image-example" : {
        "name" : "image-example",
        "label" : "Image Example",
        "type" : "image",
        "data" : "image-example.png"
    }
}
```

3. URL
  
Support url type value content.

##### JSON example output

```
{
    "url-example" : {
        "name" : "url-example",
        "label" : "URL Example",
        "type" : "url",
        "data" : {
            "url" : "http://example.com",
            "text" : "Somthing Text"
        }
    }
}
```

4. Group

Support value type content groups that accommodate other types of content.

##### JSON example output

```
{
    "group-example" : {
        "name" : "group-example",
        "label" : "Group Example",
        "type" : "group",
        "data" : {
            "url-example" : {
                "name" : "url-example",
                "label" : "URL Example",
                "type" : "url",
                "data" : {
                    "url" : "http://example.com",
                    "text" : "Somthing Text"
                }
            },
            ... 
        }
    }
}
```

##### JSON example output all fetch
```
{
    "id" : 1,
    "slug" : "example-content",
    "label" : "Example Content",
    "value" : {
        "group-example" : {
            "name" : "group-example",
            "label" : "Group Example",
            "type" : "group",
            "data" : {
                "url-example" : {
                    "name" : "url-example",
                    "label" : "URL Example",
                    "type" : "url",
                    "data" : {
                        "url" : "http://example.com",
                        "text" : "Somthing Text"
                    }
                },
                ...
            }
        }
        ...
    }
}
```