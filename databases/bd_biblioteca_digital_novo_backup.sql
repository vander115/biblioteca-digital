-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Dez-2022 às 01:56
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Estrutura da tabela `tb_adm`
--

CREATE TABLE `tb_adm` (
  `idAdm` varchar(50) NOT NULL,
  `nomeAdm` varchar(30) NOT NULL,
  `loginAdm` varchar(30) NOT NULL,
  `passAdm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_adm`
--

INSERT INTO `tb_adm` (`idAdm`, `nomeAdm`, `loginAdm`, `passAdm`) VALUES
('adm_639a5e768dd665.96130712639a5e768dd79', 'biblioteca-digital', 'biblioteca-neilyta', '$2y$10$G37Inh7qexF29.OxosefVuORE.ayo7DaOsn2e0LhsTP7ZHbRtsRYy');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_genero_livro`
--

CREATE TABLE `tb_genero_livro` (
  `idGenero` varchar(50) NOT NULL,
  `nomeGenero` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_genero_livro`
--

INSERT INTO `tb_genero_livro` (`idGenero`, `nomeGenero`) VALUES
('genero_639a6056598139.03009796639a60565981c', 'ROMANCE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_livros`
--

CREATE TABLE `tb_livros` (
  `idLivro` varchar(50) NOT NULL,
  `tituloLivro` varchar(100) NOT NULL,
  `generoLivro` varchar(50) NOT NULL,
  `autorLivro` varchar(100) NOT NULL,
  `editoraLivro` varchar(70) DEFAULT NULL,
  `tomboLivro` varchar(100) NOT NULL,
  `qtdLivro` int(11) NOT NULL DEFAULT 1,
  `statusLivro` enum('disponivel','emprestado','perdido') NOT NULL DEFAULT 'disponivel',
  `dataCadLivro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_livros`
--

INSERT INTO `tb_livros` (`idLivro`, `tituloLivro`, `generoLivro`, `autorLivro`, `editoraLivro`, `tomboLivro`, `qtdLivro`, `statusLivro`, `dataCadLivro`) VALUES
('livro_639a6360e48511.56463096', 'DOM CASMURRO', 'genero_639a6056598139.03009796639a60565981c', 'MACHADO DE ASSIS', 'SEGUINTE', '12.333/22', 4, 'disponivel', '2022-12-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pessoa`
--

CREATE TABLE `tb_pessoa` (
  `idPessoa` varchar(50) NOT NULL,
  `nomePessoa` varchar(100) NOT NULL,
  `tipoPessoa` enum('Aluno','Professor','Diretor','Coordenador','Secretário','Limpeza','Funcionário') DEFAULT 'Aluno',
  `turmaPessoa` varchar(50) NOT NULL,
  `tipoIdentPessoa` enum('CPF','Matricula') NOT NULL,
  `identPessoa` varchar(255) NOT NULL,
  `statusPessoa` enum('ativo','inativo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_req`
--

CREATE TABLE `tb_req` (
  `idReq` varchar(50) NOT NULL,
  `idPessoa` varchar(50) NOT NULL,
  `idLivro` varchar(50) NOT NULL,
  `dataReq` date NOT NULL,
  `dataEntregaReq` date NOT NULL,
  `statusReq` enum('ativa','pendente','concluida') NOT NULL,
  `qtdReq` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turma`
--

CREATE TABLE `tb_turma` (
  `idTurma` varchar(50) NOT NULL,
  `nomeTurma` varchar(100) NOT NULL,
  `anoTurma` enum('1','2','3') DEFAULT NULL,
  `anoInicial` smallint(6) NOT NULL,
  `anoFinal` smallint(6) NOT NULL,
  `statusTurma` enum('egressa','concluida') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_turma`
--

INSERT INTO `tb_turma` (`idTurma`, `nomeTurma`, `anoTurma`, `anoInicial`, `anoFinal`, `statusTurma`) VALUES
('funcionarios', 'FUNCIONÁRIOS', '1', 0, 0, 'concluida'),
('turma_639a6e682e6001.43550672639a6e682e616', 'REDES DE COMPUTADORES', '1', 2022, 2024, 'egressa'),
('turma_639a6e734f4137.12323345639a6e734f43e', 'ADMINISTRAÇÃO', '1', 2022, 2024, 'egressa'),
('turma_639a6e7d95acf5.06858429639a6e7d95ae0', 'DESENVOLVIMENTO DE SISTEMAS', '1', 2022, 2024, 'egressa'),
('turma_639a6e866439c7.09742048639a6e86643f4', 'ELETROMECÂNICA', '1', 2022, 2024, 'egressa');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_adm`
--
ALTER TABLE `tb_adm`
  ADD PRIMARY KEY (`idAdm`),
  ADD UNIQUE KEY `idAdm` (`idAdm`);

--
-- Índices para tabela `tb_genero_livro`
--
ALTER TABLE `tb_genero_livro`
  ADD PRIMARY KEY (`idGenero`),
  ADD UNIQUE KEY `idGenero` (`idGenero`);

--
-- Índices para tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD PRIMARY KEY (`idLivro`),
  ADD UNIQUE KEY `idLivro` (`idLivro`),
  ADD KEY `generoLivro` (`generoLivro`);

--
-- Índices para tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  ADD PRIMARY KEY (`idPessoa`),
  ADD UNIQUE KEY `idPessoa` (`idPessoa`),
  ADD KEY `turmaPessoa` (`turmaPessoa`);

--
-- Índices para tabela `tb_req`
--
ALTER TABLE `tb_req`
  ADD PRIMARY KEY (`idReq`),
  ADD UNIQUE KEY `idReq` (`idReq`),
  ADD KEY `idPessoa` (`idPessoa`),
  ADD KEY `idLivro` (`idLivro`);

--
-- Índices para tabela `tb_turma`
--
ALTER TABLE `tb_turma`
  ADD PRIMARY KEY (`idTurma`),
  ADD UNIQUE KEY `idTurma` (`idTurma`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_livros`
--
ALTER TABLE `tb_livros`
  ADD CONSTRAINT `tb_livros_ibfk_1` FOREIGN KEY (`generoLivro`) REFERENCES `tb_genero_livro` (`idGenero`);

--
-- Limitadores para a tabela `tb_pessoa`
--
ALTER TABLE `tb_pessoa`
  ADD CONSTRAINT `tb_pessoa_ibfk_1` FOREIGN KEY (`turmaPessoa`) REFERENCES `tb_turma` (`idTurma`);

--
-- Limitadores para a tabela `tb_req`
--
ALTER TABLE `tb_req`
  ADD CONSTRAINT `tb_req_ibfk_1` FOREIGN KEY (`idPessoa`) REFERENCES `tb_pessoa` (`idPessoa`),
  ADD CONSTRAINT `tb_req_ibfk_2` FOREIGN KEY (`idLivro`) REFERENCES `tb_livros` (`idLivro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
