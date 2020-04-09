# The T2CMS [Composer](http://getcomposer.org) Library Installer

### The composer plugin for t2cms extension installer

This is for T2CMS package authors  to require in their `composer.json`. It will 
install their package to the correct location based on the specified package 
type.

## Current Supported Package Types

| Types          | Path          | Description
| ------         | -----         | -----------
| `t2cms-module` | `cms/modules` | The module
| `t2cms-theme`  | `cms/themes`  | The application theme

## Example `composer.json` File

This is an example for a module. The only important parts to set in your
composer.json file are `"type": "t2cms-module"` which describes what your
package tells composer to load the custom installers.

```json
{
    "name": "your/module-name",
    "type": "t2cms-module"
}
```

This would install your package to the `cms/modules/` folder
when a user require your module

