#!/usr/bin/lua
print("hello aqie")
-- 行注释
--[[
	块注释
--]]

print('哈哈')

a = 'alo\n123"'
b = "alo\n123\""
c = '\97lo\10\04923"'
d = [[alo
123"]]
print(a)
print(b)
print(c)
print(d)

--[[
	布尔类型 nil和false,
	0,'','\0' 都是true
	默认是全局变量
	local 局部变量
--]]

sum = 0
num = 0
while num < 100 do
	num = num + 1
	sum = sum + num
end
print("sum=",sum)

print('==========')
sum = 0;
for i = 1,100 do
	sum = sum + i
end
print("sum=",sum)

if age == 40 and sex == 'male' then
	print('old man')
elseif age > 60 and sex ~= 'female' then
	print('old old man')
else 
	local age = io.read()
	print('YOU AGE'..age)
end
