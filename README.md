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
