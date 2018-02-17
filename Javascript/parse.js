// JavaScript Document
function trim(s) 
{
		// Remove leading spaces and carriage returns
		while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
		{ s = s.substring(1,s.length); }
		
		// Remove trailing spaces and carriage returns
		while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
		{ s = s.substring(0,s.length-1); }
		
		return s;
} 