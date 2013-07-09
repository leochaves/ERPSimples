<?php

namespace ERP\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fornecedor
 *
 * @ORM\Table(name="fornecedor")
 * @ORM\Entity
 */
class Fornecedor {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Fornecedor
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Retorna o nome do fornecedor para montagem dos labels nas caixas de seleção.
     * @return String
     */
    public function __toString() {
        return $this->nome;
    }

}