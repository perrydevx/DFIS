// JavaScript Document
function DynamicList()
{
	this.listnames = new Array(); /* name of related options in the document/page */
	this.listoptions = new Array(); /*array that handles all array values */
	
	/* method mapping*/
	this.add_dependent_list = dl_add_dependent_list;
	this.init_list_names = dl_init_list_names;
	this.for_list_name = dl_for_list_name ;
}


function dl_add_dependent_list()
{
	for (var i=0; i<arguments.length; i++)
	{
		this.listnames[i] = arguments[i].toString();
	}
}

function dl_init_list_names(p_listname,p_length)
{
	/*this.listnames[p_listname]= new Array(p_length);*/
}


function dl_for_list_name(s) { return this.listnames(s,"value"); }

function dl_add_option()
{
	for (var i=0; i < arguments.length; i++)
	{
	
	}
}
