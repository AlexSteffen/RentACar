package rentACar;
 
import java.util.*;
import java.text.*;

/**
 * Class with methods to convert values.
 * @author g.boeselager
 *
 */
public class Convert {

	/**
	 * Converts a date to a german date in string format.
	 * @param date: The date which has to be converted.
	 * @param locale: Which format has the date to be?
	 * @return Converted date string
	 */
	public static String dateToString(Date date, ConvertDateLocale locale){
		return dateToString(date, locale, false);
	}
	
	/**
	 * Converts a date to a german date to string.
	 * @param date: The date which has to be converted.
	 * @param locale: Which format has the date to be?
	 * @param withTime: Is the time to be appended?
	 * @return Converted date string.
	 */
	public static String dateToString(Date date, ConvertDateLocale locale, Boolean withTime){
		
		String timeFormat = "";
		
		if(date == null)
			return "";
		
		//is the time to be appended
		if(withTime){
			timeFormat = " HH:mm:ss";
		}
		
		try{
			SimpleDateFormat simpleDate;
			
			//simpleDate = (SimpleDateFormat)DateFormat.getDateInstance(DateFormat.MEDIUM, Locale.US);
			
			//switch format to german or us
			if(locale == ConvertDateLocale.US)
				simpleDate = new SimpleDateFormat("yyyy-MM-dd" + timeFormat);
			else
				simpleDate = new SimpleDateFormat("dd.MM.yyyy" + timeFormat);
				
			//simpleDate = (SimpleDateFormat)DateFormat.getDateInstance(DateFormat.MEDIUM, Locale.GERMAN);
			
			return simpleDate.format(date);
		}catch(Exception ex){
			throw new RuntimeException("Datum kann nicht in String kovertiert werden.");
		}		
	}
	
	/**
	 * Convert a string containing a date into a Date object.
	 * @param dateString: Contains the string that has to be converted in a Date.
	 * @param locale: Contains which time format is committed in dateString.
	 * @return Converted date
	 */
	public static Date stringToDate(String dateString, ConvertDateLocale locale){
		return stringToDate(dateString, locale, false);
	}
	
	/**
	 * Convert a string containing a date into a Date object.
	 * @param dateString: Contains the string that has to be converted in a Date.
	 * @param locale: Contains which time format is committed in dateString.
	 * @param withTime: True, if dateString contains time.  
	 * @return Converted date
	 */
	public static Date stringToDate(String dateString, ConvertDateLocale locale, Boolean withTime){
		
		String timeFormat="";
		
		if(dateString.equals(""))
			return null;
		
		//is the time to be appended
		if(withTime){
			timeFormat = " HH:mm:ss";
		}
		
		//if the date has the format 2012-02-12 instead of 2012/02/12: convert it to yyyy/MM/dd
		dateString = dateString.replace("-", "/");
		try {
			if(locale==ConvertDateLocale.US)		
				return new SimpleDateFormat("yyyy-MM-dd" + timeFormat).parse(dateString);
			else
				return new SimpleDateFormat("dd.MM.yyyy" + timeFormat).parse(dateString);
			
		} catch (ParseException e) {
			throw new RuntimeException("Datum kann nicht in Date kovertiert werden.");
		}
	}
	
}
