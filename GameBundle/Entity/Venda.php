<?php

namespace ERP\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Venda
 *
 * @ORM\Table(name="venda")
 * @ORM\Entity
 */
class Venda
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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @var \Inventario
     *
     * @ORM\ManyToOne(targetEntity="Inventario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inventario_id", referencedColumnName="id")
     * })
     */
    private $inventario;


}
