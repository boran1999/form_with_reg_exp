<?php

class formclass{

    public $name;
    public $sname;
    public $email;
    public $phone;
    public $topic;
    public $paym;
    public $soglras = false;

    protected $errors = [];

    public function has_errors(){
        return ! empty($this->errors);
    }

    public function data_insert(){
        if (!empty($_POST)) { 
            $this->name = isset($_POST['name']) ? trim($_POST['name']) : null; 
            $this->sname = isset($_POST['sname']) ? trim($_POST['sname']) : null; 
            $this->email = isset($_POST['email']) ? trim($_POST['email']) : null; 
            $this->phone = isset($_POST['phone']) ? trim($_POST['phone']) : null; 
            $this->topic = isset($_POST['top']) ? trim($_POST['top']) : null; 
            $this->paym = isset($_POST['paym']) ? trim($_POST['paym']) : null; 
            $this->soglras = isset($_POST['jel']) ? true : 0; 
        }
    }

    public function validate(){
        if (!empty($_POST)) { 
            if (empty($this->name))
            {
                $this->errors['name'] = 'Не введено имя';
                echo $this->errors['name']."<br>";
            }
            elseif (preg_match("/^[А-Я][а-я]+$/u", $this->name)==0) {
                $this->errors['reg_name']='Не корректно введено имя';
                echo $this->errors['reg_name'].'<br>';
            }
            if (empty($this->sname))
            {
                $this->errors['sname'] = 'Не введена фамилия';
                echo $this->errors['sname']."<br>";
            }
            elseif (preg_match("/^[А-Я][а-я]+$/u", $this->sname)==0) {
                $this->errors['reg_sname']='Не корректно введена фамилия';
                echo $this->errors['reg_sname'].'<br>';
            }

            if (empty($this->email))
            {
                $this->errors['email'] = 'Не введен email';
                echo $this->errors['email']."<br>";
            }
             elseif (preg_match("/^[a-zA-Zа-яА-Я0-9]+\@[a-z]+\.[a-zа-я]+$/u", $this->email)==0) {
                $this->errors['reg_email']='Не корректно введен email';
                echo $this->errors['reg_email'].'<br>';
            }

            if (empty($this->phone))
            {
                $this->errors['phone'] = 'Не введен телефон';
                echo $this->errors['phone']."<br>";
            }
             elseif (preg_match("/(^\+7\d{10}$|^\+7 \d{3} \d{3}-\d{2}-\d{2}$)/", $this->phone)==0) {
                $this->errors['reg_phone']='Не корректно введен телефон';
                echo $this->errors['reg_phone'].'<br>';
            }
            elseif(preg_match("/^\+7\d{10}$/",$this->phone)==1){
                $temp=substr($this->phone, 0,2)." ".substr($this->phone, 2,3)." ".substr($this->phone, 5,3)."-".substr($this->phone, 8,2)."-".substr($this->phone, 10,2);
                $this->phone=$temp;
            }


        }
        return ! $this->has_errors();
    }

     public function save(){
        if ($this->validate())
        {
            $dir = "logs"; 
            if(!is_dir($dir)) { 
                mkdir($dir, 0777, true); 
            } 
            $put_data = fopen('logs/form1.txt', 'a+'); 
            $file="logs/form1.txt";
            $i=sizeof(file($file));
            $i+=1;
            $contents = $i.")".$this->name."|".$this->sname."|".$this->email."|".$this->phone."|".$this->topic."|".$this->paym."|".date('Y-m-d-H-i-s')."|".$this->soglras."|".$_SERVER['REMOTE_ADDR']."|1"; 
            $cont=$contents."\n";
            fwrite($put_data, $cont); 
            fclose($put_data);    
        }
    }

    public function data_read(){
        $fp = fopen("logs/form1.txt", "r");
        $i=0;
        if ($fp) {
            while (!feof($fp)){
                $str = fgets($fp, 999);
                if(substr($str,-2,1)==1){
                    $str1=substr($str,0,-2);
                    echo "<input type='checkbox' name='f[]' value=".$str."><font color='blue'>".$str1."</font><br>";
                }
            }
        }
        else echo "Ошибка при открытии файла";
        fclose($fp);
    }

    public function data_del(){
        if(empty($_POST['f'])){ 
                echo "<h2><font color='blue'>Вы ничего не выбрали!</font></h2>";
        } 
        else{
            echo "<h2><font color='blue'>Данные файлы были успешно отмечены как удалённые</font></h2>";
            $file=file("logs/form1.txt");
            $af=$_POST['f'];
            $n=count($af);
            for($i=0;$i<$n;$i++){
                if(substr($af[$i],-1)==1){
                    for($j=0;$j<sizeof($file);$j++){
                        $t1=explode("|", $file[$j]);
                        $t2=explode("|", $af[$i]);
                        if($t1[0]==$t2[0]){
                            $file[$j]=substr($af[$i],0,-1)."0\n";
                            echo $file[$j]."<br>";
                            }
                        }
                    }
                }
            file_put_contents("logs/form1.txt", $file); 
        }   
    }
}
