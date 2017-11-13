# index
###描述:
student-index
###url地址:
/Api/Student/index
### 请求方式
【POST】

###入参
<table>
    <thead>
    <tr>
        <th>参数名称</th>
        <th style="text-align:center">参数类型</th>
        <th>是否必传</th>
        <th style="text-align:right">参数说明</th></tr>
    </thead>
    <tbody>
        <tr>
        <td>a</td>
        <td style="text-align:center">Int</td>
        <td>是</td>
        <td style="text-align:right">用户编号</td></tr>
    <tr>
            <tr>
        <td>b</td>
        <td style="text-align:center">Int</td>
        <td>是</td>
        <td style="text-align:right">用户名称</td></tr>
    <tr>
            <tr>
        <td>c</td>
        <td style="text-align:center">String</td>
        <td>是</td>
        <td style="text-align:right">用户性别</td></tr>
    <tr>
        
    </tbody>
</table>

###出参
<table id="dataTable-read">
    <thead>
    <tr>
        <th>参数名称</th>
        <th style="text-align:center">参数类型</th>
        <th>说明</th>
        <th style="text-align:right">备注</th></tr>
    </thead>
    <tbody>

        <tr >
        <td bgcolor="#ffffff">a</td>
        <td bgcolor="#ffffff"style="text-align:center">Int</td>
        <td bgcolor="#ffffff">用户编号</td>
        <td bgcolor="#ffffff"style="text-align:right"></td>
    </tr>
        <tr >
        <td bgcolor="#ffffff">b</td>
        <td bgcolor="#ffffff"style="text-align:center">Int</td>
        <td bgcolor="#ffffff">用户昵称</td>
        <td bgcolor="#ffffff"style="text-align:right"></td>
    </tr>
        </tbody>
</table>

###出参示例：
```
{
    "a": 0,
    "b": 0
}
```