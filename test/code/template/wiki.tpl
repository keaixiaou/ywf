#### Table of contents

<?php foreach($controller as $key => $value){ ?>
- [<?php echo $key+1?> <?php echo $value['name']?>](#<?php echo $key+1?>-<?php echo $value['name']?>)
<?php foreach($value['method'] as $k => $v){ ?>
    - [<?php echo $key+1?>.<?php echo $k+1?>  <?php echo $v['desc']?> - <?php echo $v['name']?>](#<?php echo $key+1?><?php echo $k+1?>-<?php echo $v['name']?>)
<?php }?>

<?php }?>

<?php foreach($controller as $ck => $cv ){ ?>
# <?php echo $ck+1?> <?php echo $cv['name']?>

<?php foreach($cv['content'] as $i => $c ){ ?>
## <?php echo $ck+1?>.<?php echo $i+1?>-<?php echo $c['name']."\n"?>
* url:  <?php echo $module?>/<?php echo $cv['name']?>/<?php echo $c['name']."\n"?>
* method : <?php echo $c['type']."\n"?>
* desc : <?php echo $c['desc']."\n"?>
* param:

| 字段        |   是否可选 |  默认值           | 说明  |
| ------------- |:-------------:|:-------------:|-----:|
<?php foreach($c['param'] as $j => $p){ ?>
|<?php echo $p[0].'|'.$p[1].'|'.$p[2]?>|

<?php }?>
* return:

```
<?php echo $c['return']."\n"?>
```
<?php }?>
<?php } ?>
