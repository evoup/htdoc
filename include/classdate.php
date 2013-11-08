<?
/**
  这是公历和农历类的定义，由于php的日期计算限制，所以只能计算1970-1938之间的时间
  农历类的计算方法使用了林洵贤先生的算法，在此表示感谢！在joy Asp可以找到林先生的大作(javascript)
*/
 
/**
* 日期类
* 本对象套用JavaScript的日期对象的方法
* 设置$mode属性，可兼容JavaScript日期对象
*/
class Date {
  var $time = 0;
  var $mode = 0;  // 本属性为与JavaScript兼容而设，$mode=1为JavaScript方式
  var $datemode = "Y-m-d H:i:s";  // 日期格式 "Y-m-d H:i:s"，可自行设定
  function Date($t=0) {
    if($t == 0)
      $this->time = time();
  }
  /**
   * 返回从GMT时间1970年1月1日0时开始的毫秒数
   */
  function getTime() {
    $temp = gettimeofday();
    return $temp[sec]*1000+round($temp[usec]/1000);
  }
  /**
   * 返回年份
   */
  function getYear() {
    $temp = getdate($this->time);
    return $temp[year];
  }
  /**
   * 返回月份
   */
  function getMonth() {
    $temp = getdate($this->time);
    return $temp[mon]-$this->mode;
  }
  /**
   * 返回日期
   */
  function getDate() {
    $temp = getdate($this->time);
    return $temp[mday];
  }
  /**
   * 返回星期
   */
  function getDay() {
    $temp = getdate($this->time);
    return $temp[wday]-$this->mode;
  }
  /**
   * 返回小时
   */
  function getHours() {
    $temp = getdate($this->time);
    return $temp[hours];
  }
  /**
   * 返回分
   */
  function getMinutes() {
    $temp = getdate($this->time);
    return $temp[minutes];
  }
  /**
   * 返回秒
   */
  function getSeconds() {
    $temp = getdate($this->time);
    return $temp[seconds];
  }
  /**
   * 设定年份
   * php 4.0.6 year 1970 -- 2038
   */
  function setYear($val) {
    $temp = getdate($this->time);
    $temp[year] = $val;
    $this->set_time($temp);
  }
  /**
   * 设定月份
   */
  function setMonth($val) {
    $temp = getdate($this->time);
    $temp[mon] = $val+$this->mode;
    $this->set_time($temp);
  }
  /**
   * 设定日期
   */
  function setDate($val) {
    $temp = getdate($this->time);
    $temp[mday] = $val;
    $this->set_time($temp);
  }
  /**
   * 设定星期
   */
  function setDay($val) {
    $temp = getdate($this->time);
    $temp[wday] = $val+$this->mode;
    $this->set_time($temp);
  }
  /**
   * 设定小时
   */
  function setHours($val) {
    $temp = getdate($this->time);
    $temp[hours] = $val;
    $this->set_time($temp);
  }
  /**
   * 设定分
   */
  function setMinutes($val) {
    $temp = getdate($this->time);
    $temp[minutes] = $val;
    $this->set_time($temp);
  }
  /**
   * 设定秒
   */
  function setSeconds($val) {
    $temp = getdate($this->time);
    $temp[seconds] = $val;
    $this->set_time($temp);
  }
  /**
   * 返回系统格式的字符串
   */
  function toLocaleString() {
    return date($this->datemode,$this->time);
  }
  /**
   * 使用GTM时间创建一个日期值
   */
  function UTC($year,$mon,$mday,$hours=0,$minutes=0,$seconds=0) {
    $this->time = mktime($hours,$minutes,$seconds,$mon,$mday,$year);
    return $this->time;
  }
  /**
   * 等价于DateAdd(interval,number,date)
   * 返回已添加指定时间间隔的日期。
   * Inetrval为表示要添加的时间间隔字符串表达式，例如分或天
   * number为表示要添加的时间间隔的个数的数值表达式
   * Date表示日期
   *
   * Interval(时间间隔字符串表达式)可以是以下任意值: 
   *  yyyy year年 
   *  q Quarter季度 
   *  m Month月 
   *  y Day of year一年的数 
   *  d Day天 
   *  w Weekday一周的天数 
   *  ww Week of year周 
   *  h Hour小时 
   *  n Minute分 
   *  s Second秒 
   *  w、y和d的作用是完全一样的，即在目前的日期上加一天，q加3个月，ww加7天。 
   */
  function Add($interval, $number, $date) {
    $date = Date::get_time($date);
    $date_time_array = getdate($date); 
    $hours = $date_time_array["hours"]; 
    $minutes = $date_time_array["minutes"]; 
    $seconds = $date_time_array["seconds"]; 
    $month = $date_time_array["mon"]; 
    $day = $date_time_array["mday"]; 
    $year = $date_time_array["year"]; 
    switch ($interval) { 
      case "yyyy": $year +=$number; break; 
      case "q": $month +=($number*3); break; 
      case "m": $month +=$number; break; 
      case "y": 
      case "d": 
      case "w": $day+=$number; break; 
      case "ww": $day+=($number*7); break; 
      case "h": $hours+=$number; break; 
      case "n": $minutes+=$number; break; 
      case "s": $seconds+=$number; break; 
    } 
    $temptime = mktime($hours ,$minutes, $seconds,$month ,$day, $year); 
    return $temptime;
  } 
  /**
   * 等价于DateDiff(interval,date1,date2)
   * 返回两个日期之间的时间间隔
   * intervals(时间间隔字符串表达式)可以是以下任意值: 
   *   w  周
   *   d  天
   *   h  小时
   *   n  分钟
   *   s  秒
   */
  function Diff($interval, $date1,$date2) { 
    // 得到两日期之间间隔的秒数 
    $timedifference = Date::get_time($date2) - Date::get_time($date1); 
    switch ($interval) { 
      case "w": $retval = bcdiv($timedifference ,604800); break; 
      case "d": $retval = bcdiv( $timedifference,86400); break; 
      case "h": $retval = bcdiv ($timedifference,3600); break; 
      case "n": $retval = bcdiv( $timedifference,60); break; 
      case "s": $retval = $timedifference; break; 
    } 
    return $retval;
  } 
 
  /**
   * 输出，根据需要直接修改本函数或在派生类中重写本函数//调用就这么写$nowt=$nowtim->display();
   */
  function display() {
    $nStr = array('日','一','二','三','四','五','六');
    $timestr= sprintf("%4d年%2d月%2d日 星期%s<br>",$this->getYear(),$this->getMonth(),$this->getDate(),$nStr[$this->getDay()%7]);
	return $timestr;
  }
  /**
   * 工作函数
   */
  function set_time(&$ar) {
    $this->time = mktime($ar[hours],$ar[minutes],$ar[seconds],$ar[mon],$ar[mday],$ar[year]);
  }
  /**
   * 转换为UNIX时间戳
   */
  function get_time($d) {
    if(is_numeric($d))
      return $d;
    else {
      if(! is_string($d)) return 0;
      if(ereg(":",$d)) {
        $buf = split(" +",$d);
        $year = split("[-/]",$buf[0]);
        $hour = split(":",$buf[1]);
        if(eregi("pm",$buf[2]))
          $hour[0] += 12;
        return mktime($hour[0],$hour[1],$hour[2],$year[1],$year[2],$year[0]);
      }else {
        $year = split("[-/]",$d);
        return mktime(0,0,0,$year[1],$year[2],$year[0]);
      }
    }
  }
} // 日期类定义结束
/**
* 农历类
*/
class Lunar {
  var $year;
  var $month;
  var $day;
  var $isLeap;
  var $yearCyl;
  var $dayCyl;
  var $monCyl;
  var $time;
  var $lunarInfo = array(
    0x04bd8,0x04ae0,0x0a570,0x054d5,0x0d260,0x0d950,0x16554,0x056a0,0x09ad0,0x055d2,
    0x04ae0,0x0a5b6,0x0a4d0,0x0d250,0x1d255,0x0b540,0x0d6a0,0x0ada2,0x095b0,0x14977,
    0x04970,0x0a4b0,0x0b4b5,0x06a50,0x06d40,0x1ab54,0x02b60,0x09570,0x052f2,0x04970,
    0x06566,0x0d4a0,0x0ea50,0x06e95,0x05ad0,0x02b60,0x186e3,0x092e0,0x1c8d7,0x0c950,
    0x0d4a0,0x1d8a6,0x0b550,0x056a0,0x1a5b4,0x025d0,0x092d0,0x0d2b2,0x0a950,0x0b557,
    0x06ca0,0x0b550,0x15355,0x04da0,0x0a5d0,0x14573,0x052d0,0x0a9a8,0x0e950,0x06aa0,
    0x0aea6,0x0ab50,0x04b60,0x0aae4,0x0a570,0x05260,0x0f263,0x0d950,0x05b57,0x056a0,
    0x096d0,0x04dd5,0x04ad0,0x0a4d0,0x0d4d4,0x0d250,0x0d558,0x0b540,0x0b5a0,0x195a6,
    0x095b0,0x049b0,0x0a974,0x0a4b0,0x0b27a,0x06a50,0x06d40,0x0af46,0x0ab60,0x09570,
    0x04af5,0x04970,0x064b0,0x074a3,0x0ea50,0x06b58,0x055c0,0x0ab60,0x096d5,0x092e0,
    0x0c960,0x0d954,0x0d4a0,0x0da50,0x07552,0x056a0,0x0abb7,0x025d0,0x092d0,0x0cab5,
    0x0a950,0x0b4a0,0x0baa4,0x0ad50,0x055d9,0x04ba0,0x0a5b0,0x15176,0x052b0,0x0a930,
    0x07954,0x06aa0,0x0ad50,0x05b52,0x04b60,0x0a6e6,0x0a4e0,0x0d260,0x0ea65,0x0d530,
    0x05aa0,0x076a3,0x096d0,0x04bd7,0x04ad0,0x0a4d0,0x1d0b6,0x0d250,0x0d520,0x0dd45,
    0x0b5a0,0x056d0,0x055b2,0x049b0,0x0a577,0x0a4b0,0x0aa50,0x1b255,0x06d20,0x0ada0,
    0x14b63);
 
  /**
   * 传回农历 y年的总天数
   */
  function lYearDays($y) {
    $sum = 348;
    for($i=0x8000; $i>0x8; $i>>=1)
      $sum += ($this->lunarInfo[$y-1900] & $i)? 1: 0;
    return $sum+$this->leapDays($y);
  }
  /**
   * 传回农历 y年闰月的天数
   */
  function leapDays($y) {
    if($this->leapMonth($y))
      return ($this->lunarInfo[$y-1900] & 0x10000)? 30: 29;
    else return 0;
  }
  /**
   * 传回农历 y年闰哪个月 1-12 , 没闰传回 0
   */
  function leapMonth($y) {
    return $this->lunarInfo[$y-1900] & 0xf;
  }
  /**
   * 传回农历 y年m月的总天数
   */
  function monthDays($y,$m) {
    return ($this->lunarInfo[$y-1900] & (0x10000>>$m))? 30: 29;
  }
  /**
   * 创建农历日期对象
   */
  function Lunar($objDate,$month=1,$day=1) {
    $leap=0;
    $temp=0;
    if(is_object($objDate))
      $this->time = mktime(0,0,0,$objDate->getMonth(),$objDate->getDate(),$objDate->getYear());
    else {
      $year = $objDate;
      $this->time = mktime(0,0,0,$month,$day,$year);
      if($year < 1970) {
        return;
        $temp = 0;
        for($i=1970; $i>$year; $i--) {
          $temp = $this->lYearDays($i);
          $offset -= $temp;
        }
      }
    }
    $offset = round($this->time/86400+25537);
 
    $this->dayCyl = $offset + 40;
    $this->monCyl = 14;
 
    for($i=1900; $i<$year && $offset>0; $i++) {
      $temp = $this->lYearDays($i);
      $offset -= $temp;
      $this->monCyl += 12;
    }
 
    if($offset<0) {
      $offset += $temp;
      $i--;
      $this->monCyl -= 12;
    }
 
    $this->year = $i;
    $this->yearCyl = $i-1864;
    $leap = $this->leapMonth($i); //闰哪个月
 
    $this->isLeap = false;
    for($i=1; $i<13 && $offset>0; $i++) {
      //闰月
      if($leap>0 && $i==($leap+1) && $this->isLeap==false) {
        $i--;
        $this->isLeap = true;
        $temp = $this->leapDays($this->year);
      }else {
        $temp = $this->monthDays($this->year, $i);
      }
 
      //解除闰月
      if($this->isLeap==true && $i==($leap+1))
        $this->isLeap = false;
 
      $offset -= $temp;
      if($this->isLeap == false)
        $this->monCyl ++;
    }
 
    if($offset==0 && $leap>0 && $i==$leap+1)
      if($this->isLeap)
        $this->isLeap = false;
      else {
        $this->isLeap = true;
        $i--;
        $this->monCyl--;
      }
 
    if($offset<0) {
      $offset += $temp;
      $i--;
      $this->monCyl--;
    }
 
    $this->month = $i;
    $this->day = $offset + 1;
  }
 
  function cyclical($num) {
    $Gan = Array("甲","乙","丙","丁","戊","己","庚","辛","壬","癸");
    $Zhi = Array("子","丑","寅","卯","辰","巳","午","未","申","酉","戌","亥");
    return $Gan[$num%10].$Zhi[$num%12];
  }
  /**
   * 输出，根据需要直接修改本函数或在派生类中重写本函数
   */
  function display() {
    $nStr = array(' ','正','二','三','四','五','六','七','八','九','十','十一','腊');
    echo sprintf("农历 %s%s月%s<br>",($this->isLeap?"闰":""),$nStr[$this->month],$this->cDay($this->day));
    echo sprintf("%s年 %s月 %s日",$this->cyclical($this->yearCyl),$this->cyclical($this->monCyl),$this->cyclical($this->dayCyl));
  }
  /**
   * 中文日期
   */
  function cDay($d) {
    $nStr1 = array('日','一','二','三','四','五','六','七','八','九','十');
    $nStr2 = array('初','十','廿','卅','　');
 
    switch($d) {
      case 10:
        $s = '初十';
        break;
      case 20:
        $s = '二十';
        break;
      case 30:
        $s = '三十';
        break;
      default :
        $s = $nStr2[floor($d/10)];
        $s .= $nStr1[$d%10];
    }
    return $s;
  }
}  // 农历类定义结束
?>