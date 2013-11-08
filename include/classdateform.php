<?php

/**
*   DateForm Class
*   Allows you to easily create drop down boxes of the year, month, and day, and keep
*   track of it via GET/POST. Hours, minutes, and seconds coming soon, as well as
*   support for SESSION/COOKIE vars.  Actually, it has the support for that right now,
*   just not as beautifully handled as the GET/POST.
*
*   Sample Usage

$form = new DateForm();
$form->changeFormNames( 'years', 'starting_year' );
$form->changeFormNames( 'months', 'starting_month' );
$form->changeFormNames( 'days', 'starting_day' );
$form->handlePostVars();

$form->printYears();
$form->printMonths();
$form->printDays();

*   @author	Jason Lotito <jason@lehighweb.com>
*   @license	LGPL
*   @version	1.1 - Tuesday, March 05, 2002 12:05:55 PM
*	@changelog
*	[[	
*		Tuesday, March 05, 2002 12:06:12 PM
*		New functionality - 
*			* Added support for Hours, Minutes, and Seconds
*			* Added support for languages via setlocale() for display of Months.
*			
*		   BC There should be no Backwards compatibility issues.
*	]]
*	@todo
*	[[
*		* Add direct support for COOKIES/SESSIONS.
*		* Add support for dynamic days based on months (optional with JS).
*		* Any other ideas, suggestions?
*	]]
*/

class DateForm
{
    
    var $today_info = array();
    var $form_names = array(    'years'     => 'form_years',
                                'months'    => 'form_months',
                                'days'      => 'form_days',
								'hours'		=> 'form_hours',
								'minutes'	=> 'form_minutes',
								'seconds'	=> 'form_seconds' );
    var $current_selections = array();
	var $starting_year = '1990';
    


	/**
	*	DateForm
	*	Constructor
	*
	*	@author	Jason Lotito
	*	@email	jason@clockmedia.com
	*	@ver	DATE
	*/
    function DateForm ()
    {
        $this->today_info = getdate();
    }
    
	/**
    *	changeFormNames
    *	Used to change the select boxes name attribute.  You need to set this
    *	_BEFORE_ using them.  Simply call this method, include the type of
    *	element you are changing (years, months, days) and then include the
    *	new name of the element.
    *
    *	@access	public
    *	@param	string	type	The name of the type: years, months, days
    *	@param	string	value	The new name of the given type.
    *	@return bool	True on success, False on failure.
    */
    function changeFormNames ( $type, $value )
    {
        $this->form_names[ $type ] = $value;
    }
	
    /**
    *	getToday
    *	Returns whatever information you want about today.  Essentially, you give
    *	it a string and it returns you the element.  The choices you have are the
    *	same as for the getdate() function. http://www.php.net/getdate
    *
    *	@access	public
    *	@param	string today	The element to return.
    *	@return	string
    */
    function getToday ( $today )
    {
        return $this->today_info[ $today ];
    }
	
	 
    /**
    *	setStartingYear
    *	Sets the starting year.
    *	The starting year is 1990 by default.  You can easily change this here, as
    *	long as the year is above 1600.  IIRC, this has something to do with getdate().
    *
    *	@access public
    *	@param	string	year	The year you want to start with.
    *	@return	bool
    */
	function setStartingYear( $year )
	{
		if ( $year < $this->today_info["year"] && $year >= 1600 )
		{
			$this->starting_year = $year;
			return true;
		}
		return false;
	}
    
	/**
	*	handlePostVars
	*	Maintains state over multiple pages.  This allows you to easily set the
	*	currently selected item to be the same thing the person chose the page
	*	before.  Works the same way as handleGetVars(), except this handles
	*	values passed by POST.
	*
	*	Simply Call this value BEFORE display the form elements on the page, and
	*	it will set the selected values as the ones displayed.  If you are
	*	displaying multiple elements of each type with different names, this
	* 	needs to be called after you reassign the names to match the changes,
	*	but before you display the element.
	*/
    function handlePostVars ()
    {
        global $HTTP_POST_VARS;
		
		foreach ( $this->form_names as $name => $form_name )
		{
	        if ( ( isset($HTTP_POST_VARS[ $form_name ]) && !empty($HTTP_POST_VARS[ $form_name ]) ) )
	        {
	            $this->current_selections[$name] = $HTTP_POST_VARS[ $form_name ];
	        }
		}
    }
    
	/**
	*	handleGetVars
	*	Maintains state over multiple pages.  This allows you to easily set the
	*	currently selected item to be the same thing the person chose the page
	*	before.  Works the same way as handlePostVars(), except this handles
	*	values passed by GET.
	*/
    function handleGetVars ()
    {
        global $HTTP_GET_VARS;
		foreach ( $this->form_names as $name => $form_name )
		{
	        if ( ( isset($HTTP_GET_VARS[ $form_name ]) && !empty($HTTP_GET_VARS[ $form_name ]) ) )
	        {
	            $this->current_selections[$name] = $HTTP_GET_VARS[ $form_name ];
	        }
		}
    }
    
     /**
    *	_getMonths
    *	Returns the months in a hash.
    *
    *	@access	private
    *	@return array
	*	@changelog
	*	[[	
	*		Tuesday, March 05, 2002 12:04:10 PM --------------------------------
	*		Changed to use strftime() instead of date() for the display values 
	*		so other languages are supported.
	*	]]
    */
    function &_getMonths()
    {
        for ( $x = 1; $x < 13; $x++ )
        {
            $val[] = date( "m", mktime ( 0,0,0,$x,1,0 ) );
            $values[] = strftime ( "%B", mktime ( 0,0,0,$x,1,0 ) );
        }
        $return_array = array( $values, $val );
        return $return_array;
    }
    
    /**
    *	getDisplayYears
    *	Returns the HTML to display a select box of years.
    *
    *	@access	public    
    *	@param	int	The number of the year that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplayYears ( $selected_year=false )
    {
        if ( !$selected_year )
        {
            if ( !empty($this->current_selections['years']) )
            {
                $selected_year = $this->current_selections['years'];
            } else {
                $selected_year = $this->today_info["year"];
            }
        }
        $values = $val = range( $this->starting_year, $this->today_info["year"] );
        return $this->select( $this->form_names['years'], $values, $val, $selected_year );
    }
    
    /**
    *	printYears
    *	Prints the years 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the year that you can select.  This is optional.
    *	@return void
    */
    function printYears ( $selected_year=false )
    {
        echo $this->getDisplayYears( $selected_year );
    }
    
    /**
    *	getDisplayMonths
    *	Returns the HTML to display a select box of months.
    *
    *	@access	public  
    *	@param	int	The number of the month that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplayMonths ( $selected_month=false )
    {
        if ( $selected_month === 0 )
            $selected_month = 12;
        if ( !$selected_month )
        {
            if ( !empty($this->current_selections['months']) )
            {
                $selected_month = $this->current_selections['months'];
            } else {
                $selected_month = $this->today_info["mon"];
            }
        }
        list( $values, $val ) = $this->_getMonths();
        return $this->select( $this->form_names['months'], $values, $val, $selected_month );
    }
    
	/**
    *	printMonths
    *	Prints the month 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the month that you can select.  This is optional.
    *	@return void
    */
    function printMonths ( $selected_month=false )
    {
        echo $this->getDisplayMonths( $selected_month );
    }
    
	/**
    *	getDisplayDays
    *	Returns the HTML to display a select box of days.  Simply defaults to 31 days.
    *
    *	@access	public
    *	@param	int	The number of the days that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplayDays ( $selected_day=false )
    {
        if ( !$selected_day )
        {
            if ( !empty($this->current_selections['days']) )
            {
                $selected_day = $this->current_selections['days'];
            } else {
                $selected_day = $this->today_info["mday"];
            }
        }
        $values = $val = range( 1, 31 );
        return $this->select( $this->form_names['days'], $values, $val, $selected_day );
    }
    
	/**
    *	printDays
    *	Prints the Days 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the days that you can select.  This is optional.
    *	@return void
    */
    function printDays ( $selected_day=false )
    {
        echo $this->getDisplayDays( $selected_day );
    }
	
	/**
    *	getDisplayHours
    *	Returns the HTML to display a select box of hours.  Simply defaults to 
	* 	24 hours.  The range used is 0 to 23 hours.
    *
    *	@access	public
    *	@param	int	The number of the hours that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplayHours ( $selected_hour=false )
    {
        if ( !$selected_hour )
        {
            if ( !empty($this->current_selections['hours']) )
            {
                $selected_hour = $this->current_selections['hours'];
            } else {
                $selected_hour = $this->today_info["hours"];
            }
        }
        $values = $val = range( 0, 23 );
        return $this->select( $this->form_names['hours'], $values, $val, $selected_hour );
    }
	
    /**
    *	printHours
    *	Prints the hours 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the hour that you can select.  This is optional.
    *	@return void
    */
    function printHours ( $selected_hour=false )
    {
        echo $this->getDisplayHours( $selected_hour );
    }
    
	/**
    *	getDisplayMinutes
    *	Returns the HTML to display a select box of minutes.  Simply defaults to 
	* 	24 hours.  The range used is 60 minutes.
    *
    *	@access	public
    *	@param	int	The number of the minutes that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplayMinutes ( $selected_minute=false )
    {
        if ( !$selected_minute )
        {
            if ( !empty($this->current_selections['minutes']) )
            {
                $selected_minute = $this->current_selections['minutes'];
            } else {
                $selected_minute = $this->today_info["minutes"];
            }
        }
        $values = $val = range( 0, 59 );
        return $this->select( $this->form_names['minutes'], $values, $val, $selected_minute );
    }
    
	/**
    *	printMinutes
    *	Prints the minutes 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the minute that you can select.  This is optional.
    *	@return void
    */
    function printMinutes ( $selected_minute=false )
    {
        echo $this->getDisplayMinutes( $selected_minute );
    }
    
	/**
    *	getDisplaySeconds
    *	Returns the HTML to display a select box of seconds.  Simply defaults to 
	* 	24 hours.  The range used is 60 seconds.
    *
    *	@access	public
    *	@param	int	The number of the seconds that you can select.  This is optional.
    *	@return string	Contains the HTML for the select box.
    */
    function getDisplaySeconds ( $selected_seconds=false )
    {
        if ( !$selected_seconds )
        {
            if ( !empty($this->current_selections['seconds']) )
            {
                $selected_seconds = $this->current_selections['seconds'];
            } else {
                $selected_seconds = $this->today_info["seconds"];
            }
        }
        $values = $val = range( 0, 59 );
        return $this->select( $this->form_names['seconds'], $values, $val, $selected_seconds );
    }
    
	/**
    *	printSeconds
    *	Prints the seconds 'select box'.
    *
    *	@access	public
    *	@param	int	The number of the second that you can select.  This is optional.
    *	@return void
    */
    function printSeconds ( $selected_seconds=false )
    {
        echo $this->getDisplaySeconds( $selected_seconds );
    }
    
    /**
    select
    $name is the name attribute of the SELECT tag.
    $values is what is displayed to the user.  This can be an array.
    $val is the VALUE attribute for the OPTION part of the SELECT tag.  This is also an array.  Each $val[] element correspond to a $values[] element.  You do not have to set this, though, if you don't, the $val will equal to the $value
    
    For example
    $val[0] is equal to $values[0]
    $val[1] is equal to $values[1]
    
    $selected_val is the value that is preselected.
    $multiple supposedly allows you to pick more than one choice, but this has yet to be tested.
    */
    function select($name,$values,$val=FALSE,$selected_val=FALSE)
    {
    	$content = "\n".'<select name="'.$name.'">'."\n";
    	$count = 0;
		$max_count = count($values);
    	while ( $count < $max_count )
    	{
			$option = $values[$count];
    		if (!isset($val[$count]))
    		{
    			$val[$count] = $values[$count];
    		}
    		if ($selected_val == $val[$count])
    		{
    			$selected = ' selected="selected"';
    		} else {
				$selected = '';
			}
    		$val[$count] = str_replace(" ", "_", $val[$count]);
    		$content .= "\t".'<option value="'.$val[$count].'"'.$selected.'>'.$values[$count].'</option>'."\n";
    		$count++;
    		$selected = "";
    	}
    	$content .= "\n".'</select>'."\n";
    	return $content;
    }
}

?>
