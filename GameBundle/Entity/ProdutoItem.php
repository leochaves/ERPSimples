<?php

namespace ERP\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoItem
 *
 * @ORM\Table(name="produto_item")
 * @ORM\Entity
 */
class ProdutoItem
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_entrada", type="date", nullable=false)
     */
    private $dataEntrada;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_entrada", type="decimal", nullable=false)
     */
    private $valorEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo", type="string", length=45, nullable=false)
     */
    private $saldo;

    /**
     * @var string
     *
     * @ORM\Column(name="flg_consolidado", type="string", length=1, nullable=false)
     */
    private $flgConsolidado;

    /**
     * @var \Fornecedor
     *
     * @ORM\ManyToOne(targetEntity="Fornecedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fornecedor_id", referencedColumnName="id")
     * })
     */
    private $fornecedor;

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
     * Set dataEntrada
     *
     * @param \DateTime $dataEntrada
     * @return ProdutoItem
     */
    public function setDataEntrada($dataEntrada)
    {
        $this->dataEntrada = $dataEntrada;
    
        return $this;
    }

    /**
     * Get dataEntrada
     *
     * @return \DateTime 
     */
    public function getDataEntrada()
    {
        return $this->dataEntrada;
    }

    /**
     * Set valorEntrada
     *
     * @param float $valorEntrada
     * @return ProdutoItem
     */
    public function setValorEntrada($valorEntrada)
    {
        $this->valorEntrada = $valorEntrada;
    
        return $this;
    }

    /**
     * Get valorEntrada
     *
     * @return float 
     */
    public function getValorEntrada()
    {
        return $this->valorEntrada;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     * @return ProdutoItem
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    
        return $this;
    }

    /**
     * Get quantidade
     *
     * @return integer 
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set saldo
     *
     * @param string $saldo
     * @return ProdutoItem
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;
    
        return $this;
    }

    /**
     * Get saldo
     *
     * @return string 
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set flgConsolidado
     *
     * @param string $flgConsolidado
     * @return ProdutoItem
     */
    public function setFlgConsolidado($flgConsolidado)
    {
        $this->flgConsolidado = $flgConsolidado;
    
        return $this;
    }

    /**
     * Get flgConsolidado
     *
     * @return string 
     */
    public function getFlgConsolidado()
    {
        return $this->flgConsolidado;
    }

    /**
     * Set fornecedor
     *
     * @param \ERP\GameBundle\Entity\Fornecedor $fornecedor
     * @return ProdutoItem
     */
    public function setFornecedor(\ERP\GameBundle\Entity\Fornecedor $fornecedor = null)
    {
        $this->fornecedor = $fornecedor;
    
        return $this;
    }

    /**
     * Get fornecedor
     *
     * @return \ERP\GameBundle\Entity\Fornecedor 
     */
    public function getFornecedor()
    {
        return $this->fornecedor;
    }

    /**
     * Set game
     *
     * @param \ERP\GameBundle\Entity\Game $game
     * @return ProdutoItem
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
}