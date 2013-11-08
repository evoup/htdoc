<?PHP
    //Clear the events array.
    $this->events = array();
    //Set the default calendar format to smallMonth.
    $this->calFormat = "smallMonth";
    //Set the calendar to display the current month and year.
    $this->calMonth = date("n");
    $this->calYear = date("Y");
    //Tell the calendar to highlight the current day when viewing the current month.
    $this->showToday = true;
    //Set the month format to long;
    $this->monthFormat = "long";
    //Start the week on Sunday
    $this->startingDOW = 0;
    //Set the display events variable to not show events.
    $this->displayEvents = false;
    //Define how the calendar is outputted from the class.
    $this->outputFormat = "echo";
    //Tell the calendar to add all get requests passed to the page.
    $this->passGetRequests = true;
    //******************** Set defaults for small calendars ********************
    //Set the small month border to 0.
    $this->smallMonthBorder = "1";
    //Set the color formats
    $this->colorSmallFormatDayOfWeek = "blue";
    $this->colorSmallFormatDateText = "black";
    $this->colorSmallFormatDateHighlight = "red";
    $this->colorSmallFormatHeaderText = "purple";
    //******************** Set defaults for large calendars ********************
    //Tell the calendar to not show the week numbers.
    $this->showWeek = false;
    //Tell the calendar to use the long day of week format
    $this->DOWformat = "long";
    //Set the height of large format calendar cells.
    $this->largeCellHeight = "80px";
    //Set the attribute for aligning the large format calendar.
    $this->largeFormatAlign = "center";
    //Set the display previous next to not show.
    $this->displayPrevNext = false;
    //Set the color formats
    $this->colorLargeFormatDayOfWeek = "#3366ff";//星期
    $this->colorLargeFormatDateText = "#003399";//日期
    $this->colorLargeFormatDateHighlight = "red";
    $this->colorLargeFormatHeaderText = "black";//年月
    $this->colorLargeFormatEventText = "black";//事件字体颜色
    $this->colorLargeFormatWeekendHighlight = "white";//今日高亮#ffffcc
    //******************** Set defaults for weekly calendars *******************
    //Set the default height of the weekly calendar
    $this->weekCalendarHeight = "520px";
    //Set the default cell height of the weekly calendar
    $this->weekCellHeight = "50px";
    $this->calWeek = time();
?>
