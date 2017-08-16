概述
---

基于yii2弄的一个接外包基础项目，包括后台，API，前台。

后台权限验证，api的auth认证都ok了

data/ 下面有个sql文件导入库里就行

运行起来就好了

更新历史
---
2017-8-8        权限管理OK

2017-8-15       auth验证OK


账号
---
spring  123456  超级管理员

anyeshe 123456  默认权限账户

admin/user/signup  添加管理员的路由

auth
---
获取token

http://api.law.lo/oauth2/token

```
grant_type:password   
username:anyeshe
password:123123
client_id:testclient
client_secret:testpass
```

需要验证的接口

```$xslt
Accept:application/json
Authorization:Bearer 0ef43c50be61b894eeba11c2f48e5b6e13de3f61
```
