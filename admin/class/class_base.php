<?php class base {
function getBaseFromSite($de=array()) { $this->settings_path="settings/config.ini"; return $this->connect($de); }
function getBaseFromAdmin($de=array()) { $this->settings_path="../settings/config.ini"; return $this->connect($de); }
function getBaseFromModule($de=array()) { $this->settings_path="../../../settings/config.ini"; return $this->connect($de); }
function getDB() { 
	$this->db=mysql_connect($this->host,$this->login,$this->password);
	$isok=mysql_select_db($this->dbname,$this->db);
	mysql_query("/*!40101 SET NAMES 'cp1251' */",$this->db);
	return $this->db;
}
function connect($de=array()) { 
	if (file_exists($this->settings_path)) {
		$this->config_ini=parse_ini_file($this->settings_path,true);
		while (list($option,$line)=each($this->config_ini)) { 
			while (list($field,$value)=each($line)) { 
				$this->$field=$value; $de[$field]=$value; 
			}	
		} 
		$de['db']=$this->getDB();	
	} 
	return $de;
}
function getSettings($de=array()) { 
    if ((isset($this->db)) && (isset($this->prefix))) {
       $sql="SELECT * FROM `".$this->prefix."_dataSettings` WHERE (1=1)";  
	   $res=mysql_query($sql,$this->db);
       if (isset($res)) { if ($res) {
			while ($row=mysql_fetch_array($res)) {
				if (isset($row['type'])) { 
					$type=$row['type'];	$name=$row['name'];
					if (isset($row[$type])) {
						$de[$name]=$row[$type]; $this->$name=$row[$type];
					}
				}
			}
        }	}
    } 
	return $de;
}
function getPattern($de=array()) { $pt="pattern"."_";
	foreach(explode("|","nm|tb|id|pr|cap|name|caption|table|property") as $key) $de[$pt.$key]="";
    if ((isset($this->db)) && (isset($this->prefix))) { if (isset($this->pattern))   {
    	$sql="SELECT * FROM `".$this->prefix."_dataPatterns` WHERE (id=\"$this->pattern\") " ;  
    	$res=mysql_query($sql,$this->db);
           if (isset($res)) { if ($res) {
               	$row=mysql_fetch_array($res);
               	foreach (explode("|","id|name|caption|table|property") as $key) {
					if (isset($row[$key])) { $$key=$row[$key]; } else { $$key=""; }
				}
				$de[$pt."id"]=$id;
				$de[$pt."name"]=$name; $de[$pt."nm"]=$name; $de["pattern"]=$name;
				$de[$pt."caption"]=$caption; $de[$pt."cap"]=$caption;
				$de[$pt."table"]=$table; $de[$pt."tb"]=$table;
				$de[$pt."property"]=$property; $de[$pt."pr"]=$property;
			}	}
    }	} 
	return $de;
}
function getSkeleton($de=array()) { $sk="skeleton"."_";
	foreach(explode("|","nm|tb|id|pr|cap|name|caption|table|property") as $key) $de[$sk.$key]="";
    if ((isset($this->db)) && (isset($this->prefix))) { if (isset($this->skeleton))   {
    	$sql="SELECT * FROM `".$this->prefix."_dataSkeletons` WHERE (id=\"$this->skeleton\") " ;  
    	$res=mysql_query($sql,$this->db);
           if (isset($res)) { if ($res) {
               	$row=mysql_fetch_array($res);
               	foreach (explode("|","id|name|caption|table|property") as $key) {
					if (isset($row[$key])) { $$key=$row[$key]; } else { $$key=""; }
				}
				$de[$sk."id"]=$id;
				$de[$sk."name"]=$name; $de[$sk."nm"]=$name; $de["skeleton"]=$name;
				$de[$sk."caption"]=$caption; $de[$sk."cap"]=$caption;
				$de[$sk."table"]=$table; $de[$sk."tb"]=$table;
				$de[$sk."property"]=$property; $de[$sk."pr"]=$property;
			}	}
    }	} 
	return $de;
}
function sqlSelect() { $ms=array();
	$this->res=mysql_query($this->sql,$this->db);
	if (!$this->res) { $this->error=mysql_errno($this->db).":".mysql_error($this->db); }
	if ($this->res)  { $this->rows_count=mysql_num_rows($this->res); }
	foreach (explode("|","sql|res|rows_count") as $key) { if(isset($this->$key)) { $ms[$key]=$this->$key; } else { $ms[$key]=""; } }
	return $ms; 
}
} ?>
