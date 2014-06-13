<?php

class View {
    /**
     * ģ���������
     * @var tVar
     * @access protected
     */       
    protected $tVar        =  array();

    /**
     * ģ�������ֵ
     * @access public
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name,$value=''){
        if(is_array($name)) {
            $this->tVar   =  array_merge($this->tVar,$name);
        }else {
            $this->tVar[$name] = $value;
        }
    }

    /**
     * ȡ��ģ�������ֵ
     * @access public
     * @param string $name
     * @return mixed
     */
    public function get($name=''){
        if('' === $name) {
            return $this->tVar;
        }
        return isset($this->tVar[$name])?$this->tVar[$name]:false;
    }

    /**
     * ����ģ���ҳ����� ���Է����������
     * @access public
     * @param string $templateFile ģ���ļ���
     * @param string $charset ģ������ַ���
     * @param string $contentType �������
     * @param string $content ģ���������
     * @param string $prefix ģ�建��ǰ׺
     * @return mixed
     */
    public function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
		
        G('viewStartTime');
        // ��ͼ��ʼ��ǩ
        tag('view_begin',$templateFile);
        // ��������ȡģ������
        $content = $this->fetch($templateFile,$content,$prefix);
        // ���ģ������
        $this->render($content,$charset,$contentType);
        // ��ͼ������ǩ
        tag('view_end');
    }

    /**
     * ��������ı����԰���Html
     * @access private
     * @param string $content �������
     * @param string $charset ģ������ַ���
     * @param string $contentType �������
     * @return mixed
     */
    private function render($content,$charset='',$contentType=''){
        if(empty($charset))  $charset = C('DEFAULT_CHARSET');
        if(empty($contentType)) $contentType = C('TMPL_CONTENT_TYPE');
        // ��ҳ�ַ�����
        header('Content-Type:'.$contentType.'; charset='.$charset);
        header('Cache-control: '.C('HTTP_CACHE_CONTROL'));  // ҳ�滺�����
        header('X-Powered-By:ThinkPHP');
        // ���ģ���ļ�
        echo $content;
    }

    /**
     * �����ͻ�ȡģ������ �������
     * @access public
     * @param string $templateFile ģ���ļ���
     * @param string $content ģ���������
     * @param string $prefix ģ�建��ǰ׺
     * @return string
     */
    public function fetch($templateFile='',$content='',$prefix='') {
        if(empty($content)) {
            // ģ���ļ�������ǩ
            tag('view_template',$templateFile);
            // ģ���ļ�������ֱ�ӷ���
            if(!is_file($templateFile)) return NULL;
        }
        // ҳ�滺��
        ob_start();
        ob_implicit_flush(0);
        if('php' == strtolower(C('TMPL_ENGINE_TYPE'))) { // ʹ��PHPԭ��ģ��
            // ģ�����б����ֽ��Ϊ��������
            extract($this->tVar, EXTR_OVERWRITE);
            // ֱ������PHPģ��
            empty($content)?include $templateFile:eval('?>'.$content);
        }else{
            // ��ͼ������ǩ
            $params = array('var'=>$this->tVar,'file'=>$templateFile,'content'=>$content,'prefix'=>$prefix);
            tag('view_parse',$params);
        }
        // ��ȡ����ջ���
        $content = ob_get_clean();
        // ���ݹ��˱�ǩ
        tag('view_filter',$content);
        // ���ģ���ļ�
        return $content;
    }
}