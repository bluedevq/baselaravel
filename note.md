## Các package base đang dùng
- Debug bar: https://github.com/barryvdh/laravel-debugbar
- Breadcrumbs: https://github.com/davejamesmiller/laravel-breadcrumbs
- Column sortable: https://github.com/Kyslik/column-sortable
- Laravel collective: https://github.com/LaravelCollective/html
- Flysystem aws s3: https://github.com/thephpleague/flysystem-aws-s3-v3
- Laravel validator: https://github.com/andersao/laravel-validator

## Thư mục core
1. Common
- Common.php: function common dùng cho source code base và dự án

2. Console
- Commands
  + BaseCommand.php: base command (đang build)

3. Helpers
- ChatWork (chatwork api): push message to Chatwork
- Dumper: dump database (mysql, postgresql, mongodb ...)
- GMO: lib GMO
- Zipper: zip file, folder
- ExportCsv.php: export CSV
- Url.php: backUrl, getBackUrl ... dùng cho back đi back lại giữa các màn hình

4. Http
- Controllers
  + BaseController.php: các controller sẽ đc kế thừa từ file này (FrontendController.php, BackendController.php, ApiController.php ...)

5.Mail
- BaseMail.php: base send mail

6. Models
- Concerns
  + BaseSoftDelete.php: custom model softdelete
  + BaseSoftDeletingScope.php: custom model softdelete
  + InteractsWithPivotTable.php: custom relation with pivot table softdelete 
- Pivots
  + BasePivot.php
- Relations
  + BelongsToManySoft.php: belongsToMany with softdelete
  + HasRelationships.php
- BaseModel.php: base model with not softDelete
- BaseModelSoftDelete.php: base model with softDelete

7. Providers
- Collective (https://laravelcollective.com)
  + BaseFormBuilder.php: custom Form collective
  + BaseHtmlBuilder.php: custom Html collective
- Facades
  + Log: custom channel log
  + Storages: custom storages
  + CustomHtmlServiceProvider.php

8. Repositories
- Contracts
  + BaseRepositoryInterface.php
- BaseRepository.php: base repository

9. Services
- BaseService.php (đang build): xử lý logic controller, helper ...

10. Validator
- Concerns
  + BaseValidatesAttributes.php: file custom validate
- Contracts
  + BaseValidatorContract.php
- BaseValidator.php: base validator

## Cách khai báo và sử dụng relation
- One To One (1-1)
```
public funcion roles()
{
    return $this->hasOne(Role::class, 'user_id');
}
```

- One To Many (1-n)
```
public function roles()
{
    return $this->hasMany(Role::class, 'user_id');
}
```
- Many to Many
```
// default
public function roles()
{
    return $this->belongsToMany(Role::class, 'user_roles_table', 'user_id', 'role_id')
        ->withSoftDeletes()
        ->withTimestamps();
}

// with pivot
public function roles()
{
    return $this->belongsToMany(Role::class, 'user_roles_table', 'user_id', 'role_id')
        ->withPivot(['type'])
        ->withPivotValue('type', 0) // auto save default value
        ->withSoftDeletes()
        ->withTimestamps();
}

```

## Các phần đang build
- API
- Event
- ...





	
