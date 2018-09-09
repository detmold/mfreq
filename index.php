<?php 
class Freq {
    public $n; // wielkosc tablicy wejsciowej
    public $m; // liczba zapytan
    public $l; // przedzial lewy
    public $r; // przedzial prawy
    public $k; // ilosc powtorzen w przedziale domknietym <$l,$k>
    public $A = array(); // tablica o dlugosci $n 
    public $L = array();
    public $R = array();
    public $mid; // index of the middle element in $A array
    public $output;

    private function process() {
        $this->R = array();
        $this->L = array();

        $this->L[1] = 1;
        for ($i=2; $i<=$this->n; $i++) {
            $this->L[$i] = $this->A[$i] == $this->A[$i - 1] ? $this->L[$i - 1] : $i; 
        }

        $this->R[$this->n] = $this->n;
        for ($i=$this->n-1; $i>=1; $i--) {
            $this->R[$i] = $this->A[$i] == $this->A[$i + 1] ? $this->R[$i + 1] : $i; 
        }
    }

    private function computeOutput() {
        $this->mid = ceil(($this->l + $this->r) / 2);
        $repeat = min($this->R[$this->mid], $this->r) - max($this->L[$this->mid], $this->l) + 1;  // wyliczamy liczbe powtorzen elementu $this->A[$this->mid]
        // w zadanym przedziale domknietym <$l,$r> 
        $this->output = $repeat >= $this->k ? $this->A[$this->mid] : -1;
    }

    public function init() {
        $arrayAndQueries = explode(' ', stream_get_line(STDIN, 10000000000000, PHP_EOL));
        $this->n = $arrayAndQueries[0];
        $this->m = $arrayAndQueries[1];
        $this->A = explode(' ', stream_get_line(STDIN, 10000000000000, PHP_EOL));
        array_unshift($this->A, 1); // to zrobione po te ze liczymy od elementu $this->A[1] a nie $this->[0]
        $this->process();
        for ($j=0; $j<$this->m; $j++) {
            $data = explode(' ', stream_get_line(STDIN, 10000000000000, PHP_EOL));
            $this->l = $data[0];
            $this->r = $data[1];
            $this->k = $data[2];
            
            $this->computeOutput();
            echo $this->output . PHP_EOL;
        }
    }

}


$freq = new Freq();
$freq->init();
?>