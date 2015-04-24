<?php
class Documento extends EntidadBase{
    private $id;
    private $idtipodocumento;
    private $idformato;
    private $idusuario;
    private $host;
    private $fechahora;
    private $lugar;
    private $fecharegistro;
    private $cite;
    private $referencia;
    private $tenor;
    private $nroanexos;
    private $anexos;
    private $nrofolios;
    private $estado;
    
    public function __construct() {
        $table="documento";
        parent::__construct($table);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getIdtipodocumento() {
        return $this->idtipodocumento;
    }

    public function setIdtipodocumento($idtipodocumento) {
        $this->idtipodocumento = $idtipodocumento;
    }

    public function getIdformato() {
        return $this->descripcion;
    }

    public function setIdformato($idformato) {
        $this->idformato = $idformato;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getHost() {
        return $this->host;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function getFechahora() {
        return $this->fechahora;
    }
    
    public function setFechahora($fechahora) {
        $this->fechahora = $fechahora;
    }

    function getLugar() {
        return $this->lugar;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    public function getFecharegistro() {
        return $this->fecharegistro;
    }

    public function setFecharegistro($fecharegistro) {
        $this->fecharegistro = $fecharegistro;
    }

    public function getCite() {
        return $this->cite;
    }

    public function setCite($cite) {
        $this->cite = $cite;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }

    public function getTenor() {
        return $this->tenor;
    }

    public function setTenor($tenor) {
        $this->tenor = $tenor;
    }

    public function getNroanexos() {
        return $this->nroanexos;
    }

    public function setNroanexos($nroanexos) {
        $this->nroanexos = $nroanexos;
    }

    public function getAnexos() {
        return $this->anexos;
    }

    public function setAnexos($anexos) {
        $this->anexos = $anexos;
    }

    public function getNrofolios() {
        return $this->nrofolios;
    }

    public function setNrofolios($nrofolios) {
        $this->nrofolios = $nrofolios;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function save(){
        $query="INSERT INTO documento (id,idtipodocumento,idformato,idusuario,host,fechahora,lugar,fecharegistro,cite,referencia,tenor,nroanexos,anexos,nrofolios,estado)
                VALUES(NULL,
                '".$this->idtipodocumento."',
                '".$this->idformato."',
                '".$this->idusuario."',
                '".$this->host."',
                '".$this->fechahora."',
                '".$this->lugar."',
                '".$this->fecharegistro."',
                '".$this->cite."',
                '".$this->referencia."',
                '".$this->tenor."',
                '".$this->nroanexos."',
                '".$this->anexos."',
                '".$this->nrofolios."',
                '".$this->estado."');";
//        echo $query; exit();
        $save=$this->db()->query($query);

        // $this->db()->error;
        return $save;
    }
    public function update(){       
        $query="UPDATE documento SET 
                idusuario    = '".$this->idusuario."',
                fechahora    = '".$this->fechahora."',
                lugar        = '".$this->lugar."',
                cite         = '".$this->cite."',
                referencia   = '".$this->referencia."',
                tenor        = '".$this->tenor."',
                nroanexos    = '".$this->nroanexos."',
                anexos       = '".$this->anexos."',
                nrofolios    = '".$this->nrofolios."'
                WHERE id     = ".(int)$this->id.";";
//        echo $query; exit();
        $update = $this->db()->query($query);
        //$this->db()->error;
        return $update;
    }

    public function borrar($id){
        //elimina en remitentes
        $sql = "DELETE FROM remitente WHERE iddocumento =".$id;
        $this->db()->query($sql);
        
        //elimina en destinatario
        $sql = "DELETE FROM destinatario WHERE iddocumento =".$id;
        $this->db()->query($sql);
        
        //elimina en concopia
        $sql = "DELETE FROM concopia WHERE iddocumento =".$id;
        
        $this->db()->query($sql);
        $sql = "DELETE FROM documento WHERE id =".$id;
        $delete = $this->db()->query($sql);
        return $delete;
    }

    public function getCargoExistente($cargo){
        $query = "SELECT cargo FROM cargos WHERE cargo = '$cargo' AND estado = 1";
        $cargo = $this->ejecutarSql($query);
        // echo '<pre>';
        // print_r( $cargo->cargo); exit();
        return (isset($cargo->cargo)) ? true : false;
    }

    public function getBandejaSalida(){
        $sql = "select d.id,concat(td.tipodocumento,' - ',DATE_FORMAT(fechahora,'%d/%m/%Y'),'<br>',cite) "
                . "as documento,referencia,td.tipodocumento from documento d join tipodocumento td on d.idtipodocumento = td.id "
                . "ORDER BY d.id DESC;";
        $carta = $this->ejecutarSql($sql);
        return $carta;
    }
    
    public function getRemitente($id){
        $sql = "select au.id, nombres,apellidos,c.cargo from documento d "
                . "join remitente r on r.iddocumento = d.id "
                . "join actividadusuario au on au.id = r.idactividadusuario "
                . "join antiguedad a on a.idactividadusuario = au.id "
                . "join cargos c on c.id = a.idcargo "
                . "join usuarios u on u.id  = au.idusuarios where d.id = ".$id;
        $remit = $this->ejecutarSql($sql);
        return $remit;
    }
    
    public function getDestinatario($id){
        $sql = "select au.id, nombres,apellidos, c.cargo from documento d "
                . "join destinatario de on de.iddocumento = d.id "
                . "join actividadusuario au on au.id = de.idactividadusuario "
                . "join antiguedad a on a.idactividadusuario = au.id "
                . "join cargos c on c.id = a.idcargo "
                . "join usuarios u on u.id  = au.idusuarios where d.id = ".$id;
//        echo $sql;
        $dest = $this->ejecutarSql($sql);
        return $dest;
    }

    public function getConcopia($id){
        $sql = "select au.id, nombres,apellidos,c.cargo from documento d "
                . "join concopia cc on cc.iddocumento = d.id "
                . "join actividadusuario au on au.id = cc.idactividadusuario "
                . "join antiguedad a on a.idactividadusuario = au.id "
                . "join cargos c on c.id = a.idcargo "                
                . "join usuarios u on u.id  = au.idusuarios where d.id = ".$id;
        $dest = $this->ejecutarSql($sql);
        return $dest;
    }

    public function getUsuarioAll(){
        $sql = "select au.id,nombres,apellidos from actividadusuario au join usuarios u on u.id  = au.idusuarios";
        $remit = $this->ejecutarSql($sql);
        return $remit;
    }

//    public function getDestinatarioAll(){
//        $sql = "select au.id,nombres,apellidos from actividadusuario au join usuarios u on u.id  = au.idusuarios";
//        $dest = $this->ejecutarSql($sql);
//        return $dest;
//    }

//    public function getConcopiaAll(){
//        $sql = "select au.id,nombres,apellidos from actividadusuario au join usuarios u on u.id  = au.idusuarios";
//        $dest = $this->ejecutarSql($sql);
//        return $dest;
//    }
    //Retorna el último ID registrado en la tabla Documento
    public function getIdidentity(){
        $sql = "select max(id) as id from documento";
        $id = $this->ejecutarSql($sql);
        return $id[0]->id;
    }
    
    public function getCiteExistDoc($id){
        $sql = "select concat(ct.acronimo,'-',ct.contador+1) as acronimo from antiguedad a join actividadusuario au "
                . "on a.idactividadusuario = au.id join estructura e on e.id = a.idestructura "
                . "join cite ct on ct.idestructura = e.id where ct.estado = 1 and au.id = ".$id;
        $cite = $this->ejecutarSql($sql);
        if(is_array($cite)) {
            return $cite[0]->acronimo;
        } else {
            return false;
        }
    }
    
}
?>