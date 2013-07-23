<?php

namespace ERP\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity
 */
class Pedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="decimal", nullable=false)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_postagem", type="string", length=13, nullable=true)
     */
    private $cod_postagem;
  
    /**
     * @var string
     *
     * @ORM\Column(name="flg_pago", type="string", length=1, nullable=false)
     */
    private $flg_pago;    
    
    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @var \Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * })
     */
    private $game;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valor
     *
     * @param float $valor
     * @return Pedido
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Pedido
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set cliente
     *
     * @param \ERP\GameBundle\Entity\Cliente $cliente
     * @return Pedido
     */
    public function setCliente(\ERP\GameBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \ERP\GameBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set game
     *
     * @param \ERP\GameBundle\Entity\Game $game
     * @return Pedido
     */
    public function setGame(\ERP\GameBundle\Entity\Game $game = null)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return \ERP\GameBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Pedido
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set flg_pago
     *
     * @param string $flgPago
     * @return Pedido
     */
    public function setFlgPago($flgPago)
    {
        $this->flg_pago = $flgPago;

        return $this;
    }

    /**
     * Get flg_pago
     *
     * @return string 
     */
    public function getFlgPago()
    {
        return $this->flg_pago;
    }

    /**
     * Set cod_postagem
     *
     * @param string $codPostagem
     * @return Pedido
     */
    public function setCodPostagem($codPostagem)
    {
        $this->cod_postagem = $codPostagem;

        return $this;
    }

    /**
     * Get cod_postagem
     *
     * @return string 
     */
    public function getCodPostagem()
    {
        return $this->cod_postagem;
    }
}
