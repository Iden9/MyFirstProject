<?php
function is_login(){//�ж��û��Ƿ��¼
	if(empty($_SESSION["role"])){
		return false;
	}else{
		return true;
	}
}
function is_student(){//�жϵ�¼�û��Ƿ���ѧ��
	if(is_login() && $_SESSION["role"]=="student"){
		return true;
	}else{
		return false;
	}
}
function is_teacher(){//�жϵ�¼�û��Ƿ��ǽ�ʦ
	if(is_login() && $_SESSION["role"]=="teacher"){
		return true;
	}else{
		return false;
	}
}
function is_admin(){//�жϵ�¼�û��Ƿ��ǹ���Ա
	if(is_login() && $_SESSION["role"]=="admin"){
		return true;
	}else{
		return false;
	}
}
?>
