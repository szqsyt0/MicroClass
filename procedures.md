存储过程的参数说明
==================================================
# 用户相关
===============
## 登录
  登录验证的存储过程。

### 参数列表

#### 输入
1. 用户名 varchar(32) 可以为邮箱或用户名
2. 密码 char(32) md5加密过的32位密码

#### 输出
4. id unsignded int 型的用户id号
5. 身份 varchar(6) 管理员为sadmin或admin，用户为user
6. 错误代码 0登录成功，1密码错误，2无该用户

===============
## 注册
  注册新用户，可以注册为管理员

### 参数列表

#### 输入
1. 用户名 varchar(32) 唯一的用户名
2. 密码 char(32) md5加密的32位密码
3. 邮箱 varchar(32) 唯一的邮箱
4. 手机号码 varchar(11) 手机号码，不可重复
5. 身份 varchar(6) 可以为'admin' 'sadmin' 'user'，默认为'user'

#### 输出
6. 错误代码 int 0注册成功，1用户名存在，2邮箱存在，3手机号存在

===============
## 改密码

### 参数列表

#### 输入
1. 用户id int unsigned 用户id
2. 原密码 char(32) md5加密的32位密码
3. 新密码 char(32) 32为md5

#### 输出
1. 错误代码 0成功，1原密码错误，2用户id不存在，3新密码格式错误

===============
## 获取用户信息
获取某用户的所有信息
### 参数列表

#### 输入
1. id int unsigned

#### 输出
2. 错误代码 0成功, 1id不存在

===============
## 返回所有管理员

### 参数列表

#### 输入
1. 页码 int 第几页
2. 页大小 int 一页显示多少条

#### 输出
3. 错误代码 0成功, 1失败(页码和页大小不对)

===============
## 删除用户

### 参数列表

#### 输入
1. 用户id int 

#### 输出
2. 错误代码 0成功, 1用户id不存在

==================================================
# 分类相关
===============
## 返回所有分类
分类为一树状结构，没写分页功能

### 无参数

===============
## 修改分类

### 参数列表

#### 输入
1. 分类id int unsigned 当前分类id
2. 新分类名 varchar(32) 新分类的名字
3. 新父类名 varchar(32) 新父分类的名字

#### 输出
1. 错误代码 0成功，1分类id不存在，2父分类名不存在

===============
## 删除分类
删除分类时将删除该分类下面所有的子分类

### 参数列表

#### 输入
1. 分类id int unsigned

#### 输出
1. 错误代码 0成功，1分类id不存在

==================================================
# 评论相关
===============
## 返回所有评论

### 参数列表

#### 输入
1. 页码 int 第几页
2. 页大小 int 一页显示多少条

#### 输出
3. 错误代码 0成功, 1失败(页码和页大小不对)

===============
## 删除评论
删除评论及该评论下的所有评论

### 参数列表

#### 输入
1. 评论id

#### 输出
1. 错误代码 0成功，1评论id不存在
