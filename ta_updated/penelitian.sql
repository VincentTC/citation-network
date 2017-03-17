-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2014 at 06:40 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `penelitian`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_penelitian`
--

CREATE TABLE IF NOT EXISTS `data_penelitian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` text NOT NULL,
  `peneliti` text NOT NULL,
  `tahun_publikasi` int(11) NOT NULL,
  `masalah` text NOT NULL,
  `deskripsi_masalah` text NOT NULL,
  `keyword` text NOT NULL,
  `domain_data` text NOT NULL,
  `deskripsi_domain_data` text NOT NULL,
  `metode` text NOT NULL,
  `deskripsi_metode` text NOT NULL,
  `hasil` text NOT NULL,
  `creater` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `data_penelitian`
--

INSERT INTO `data_penelitian` (`id`, `judul`, `peneliti`, `tahun_publikasi`, `masalah`, `deskripsi_masalah`, `keyword`, `domain_data`, `deskripsi_domain_data`, `metode`, `deskripsi_metode`, `hasil`, `creater`) VALUES
(1, 'Supporting Multilingual Information Retrieval in Web Applications: An English-Chinese Web Portal Experiment', 'Jialun Qin, Yilu Zhou, Michael Chau, Hsinchun Chen', 2003, 'Evaluating a multilingual web', 'Developing and evaluating a multilingual English-Chinese Web portal in the business domain with CLIR and MLIR.', 'Multilingual Information Retrieval', 'The AI Lab SpidersRUs toolkit', 'The AI Lab SpidersRUs toolkit is used to build the English and Chinese collections for the Web portal. Each collection consists of about 100,000 IT business Web pages.<br/>\r\nWe built our own lexicon for the IT business domain in both English and Chinese.', 'A dictionary-based approach', 'A dictionary-based approach has been adopted that combines phrasal translation, co-occurrence analysis, and pre- and post-translation query expansion\r\n<br/>\r\nPhrasal translations and co-occurrence analysis were also implemented.', 'All methods except word-by-word get over 70% performance in monolingual system.<br/>\r\nPhrasal and co-occurrence disambiguation performed much better than word-by-word translation, achieving a 74.6% improvement.\r\n<br/>\r\nPre and post-translation expansion did not improve the performance.', '7'),
(2, 'Improving Interactive Retrieval by Combining Ranked Lists and Clustering', 'Anton Leuski, James Allan', 2004, 'Organizing the documents', 'Organizing the documents returned by an information retrieval system in response to a natural language query. ', 'Interactive Retrieval', 'TREC ad-hoc queries, relevance judgments', 'TREC ad-hoc queries that ran against the documents in TREC volumes 2 and 4 (2.1GB) that include articles from Wall Street Journal, Financial Times, and Federal Register.<br/> \r\nRelevance judgments supplied by NIST accessors (Harman & Voorhees, 1997)', 'Ranked list, clustering of the results', 'Ranked list, clustering of the results.\r\nevaluate by comparing to the ranked list and interactive relevance feedback search strategies.', 'Significantly exceeds the initial performance of the ranked list\r\nand rivals in its effectiveness the traditional relevance feedback methods.', ''),
(3, 'Using Citations to Generate surveys of Scientific Paradigms', 'Saif Mohammad, Bonnie Dorr, Melissa Egan, Ahmed Hassan,Pradeep Muthukrishan, Vahed Qazvinian, Dragomir Radev, David Zajic', 2009, 'Automatically generated survey', 'First steps in producing an automatically generated, readily consumable, technical survey.', 'Generate surveys', 'ACL Anthology', 'The ACL Anthology is a collection of papers.\r\n<br/>\r\nEvaluation experiments are on a set of papers in the research area of Question Answering (QA)and another set of papers on Dependency parsing(DP).', 'Bibliometric lexical link mining and summarization techniques', 'Combining bibliometric lexical link mining and summarization techniques<br/>\r\nFour summarization systems for survey-creation approach: Trimmer,LexRank, C-LexRank, and C-RR.<br/>\r\nFor this we evaluated using : nugget-based pyramid evaluation and ROUGE', 'Both citation texts and abstracts have unique survey-worthy information. Multidocument summarization especially technical survey creation—benefits considerably from citation texts.', ''),
(4, 'Multi-document Summarization by Graph Search and Matching', 'Inderjeet Mani, Eric Bloedorn', 1997, 'Summarize multiple documents', 'Summarize the similarities and differences in information content among multiple documents in a way that is sensitive to the needs of the user.', 'Graph Search and Matching', 'Four queries from the TREC (Harman 1994)', 'Four queries from the TREC (Harman 1994) collection of topics, with the idea of exploiting their associated (binary) relevance judgments.\r\n<BR/>\r\nFor this experiment, 15 pairs of articles on international events were selected from searches on the World Wide Web.', 'Graph representation', 'Graph representation by making abstract content representation based on explicitly representing entities and the relations between entities, of the sort that can be robustly extracted by current information extraction systems. ', 'Summaries were used, the performance was faster than with fulltext (F=32.36, p < 0.05, using analysis of variance F-test) without significant loss of accuracy. <br/>\r\nShorter texts are effective enough to support accurate retrieval.<br/>\r\nThe biggest improvement comes from the differences found using spreading', ''),
(5, 'Resolving Ambiguity for Cross-language Retrieval', 'Lisa Ballesteros, W. Bruce Croft', 1998, 'Resolving Ambiguity for Cross-language Retrieval', 'One of the main hurdles to improved CLIR effectiveness is resolving ambiguity associated with translation.\r\n\r\nResources for cross-language retrieval can require tremendous manual effort to generate and may be difficult to acquire. Therefore methods which capitalize on existing resources must be\r\nfound.', 'Resolving Ambiguity', 'TREC AP English', 'Evaluation was performed on the 748 MB TREC AP English collection (having 243K documents covering ’88-’90) with provided relevance judgments. Co-occurrence statistics were collected from the portion of the AP collection covering 1989.', 'Cooccurrence statistics, parallel corpus analysis', 'Technique based on cooccurrence statistics from unlinked corpora which can be used to reduce the ambiguity associated with phrasal and term translation. \r\n<br/>\r\nEmploy parallel corpus analysis to look at the impact of query term disambiguation on CLIR effectiveness. ', 'Combining corpus analysis techniques can be used to disambiguate terms and phrases. In combination with query expansion, it significantly reduces the error associated with query translation. Techniques based on unlinked corpora can perform as well or better than techniques based on more complex or scarce resources. Our co-occurrence method was better at disambiguating queries than was our parallel corpus technique.', ''),
(6, 'Word Sense Disambiguation with a Corpus-based Semantic Network', 'Qujiang Peng, Takeshi Ito, Teiji Furugori ', 1996, 'WSD', 'Determining the meaning of words in text is by Word sense disambiguation (WSD)', 'WSD', '10 polysemous words', 'We tested our method for the same 10 \r\npolysemous words used in our previous \r\nwork with 756 instances collected and other materials.', 'Corpus-based semantic network', 'Uses a corpus-based semantic network.   Creating a semantic network that represents semantic distances among words in general, we resolve the ambiguities activating the network. ', 'Achieved a success rate of 92.1%, which is better than those of other comparable', ''),
(7, 'Word Sense Disambiguation with Automatically Acquired Knowledge', 'Ping Chen, Wei Ding, Max Choly, Chris Bowes', 2012, 'WSD that applied in any real world applications', 'WSD that applied in any real world applications with automatically acquired knowledge', 'Automatically Acquired Knowledge', 'Senseval-2 fine-grained English testing corpus and SemEval 2007 Task 7 coarse-grained testing corpus. ', 'Testing with two large scale WSD evaluation corpora, Senseval-2 fine-grained English testing corpus and SemEval 2007 Task 7 coarse-grained testing corpus. ', 'Automatically Acquired Knowledge', '1) Corpus building through search engines<br/>\r\n2) Document cleaning<br/>\r\n3) Sentence segmentation<br/>\r\n4) Parsing<br/>\r\n5) Dependency relation merging<br/>\r\n6) Dependency relation normalization<br/>', 'Achieves 82.64% in both precision and recall, which clearly outperforms the best unsupervised WSD system and performs similarly as the best supervised system<br/>\r\n\r\nOur WSD method overcomes the knowledge acquisition bottleneck faced by many current WSD systems. Our main finding is the “greater-sum” disambiguation capability of these three knowledge\r\nsources,the SemEval-2007 and Senseval-2 corpora', ''),
(8, 'An Efficient Linear Text Segmentation Algorithm Using Hierarchical Agglomerative Clustering', 'Ji-Wei Wu', 2011, 'Efficient linear text \r\nsegmentation', 'Efficient linear text \r\nsegmentation algorithm based on hierarchical agglomerative \r\nclustering', 'Text Segmentation', 'Test corpus', 'Test corpus consists of 700 samples. A \r\nsample is a concatenation of ten text segments. The 700 samples are divided into 4 sets according to the range of the number of sentences', 'Hierarchical learning strategy', 'Tokenization, stopword removal, \r\nand stemming. After text preprocessing, the text can be represented \r\nas vectors, each of which represents a sentence within the \r\ntext. A part of sentence similarities are then computed to \r\nconstruct the sentence-similarity matrix. Finally, the optimal \r\ntopic boundaries are identified by the proposed algorithm. ', 'Linear text segmentation \r\nalgorithm (i.e., TSHAC) outperforms the linear time algorithm, TextTiling. TSHAC also provides comparable results with other algorithms. TSHAC provides a fully automatic process for linear text segmentation without auxiliary knowledge base, parameter setting, or user involvement.', ''),
(9, 'The Effects of Query Structure and Dictionary Setups in Dictionary-Based Cross-language Information Retrieval', 'Ari Pirkola', 1998, 'Effects of query structure and various setups of translation dictionaries on the performance of cross-language information retrieval (CLIR)', 'In this study, the effects of query structure and various setups of translation dictionaries on the performance of cross-language information retrieval (CLIR) were tested.\r\n', 'Dictionary-Based Information Retrieval', 'AP Newswire, Federal Register, DOE abstracts', 'The test collection consisted of the AP Newswire, Federal Register, and DOE abstracts subsets of the TREC collection.', 'Combine general language MRD and a domain specific MRD\r\n', 'The translation polysemy and the dictionary coverage problems were attacked by means of the combination of a general language MRD and a domain specific MRD\r\n.', 'There was only a slight difference in performance between the original English queries and the best cross-language queries.\r\n<br/>\r\nA cross-language IR system based on MRD translation is able to achieve the\r\nperformance level of a monolingual system, if queries are structured and if both general terminology and domain spe-\r\ncific terminology are available in translation.', ''),
(10, 'A New Approach to Feature Selection in Text Classification', 'Yi Wang, Xiao-Jing Wang', 2005, 'New approach to feature selection to do feature reduction', 'New approach to feature selection to do feature reduction, which is a constituent process in representing texts.', 'Feature Selection', 'Chinese text classification corpus', 'Divide the corpus into two non-intersected sets: a training set containing 10 categories with 100 texts in each and a test set containing the same 10 categories with another 100 texts in each also', 'Variance-mean based feature filtering', 'Variance-mean based feature filtering method of feature selection to do feature reduction in the representation phase.', 'Variance-mean method can gain higher performance at a very low dimension, and quickly reach a peak, which means much less computing time and almost best performance than DF, CHI.', ''),
(11, 'Text Clustering with Feature Selection by Using Statistical Data', 'Yanjun Li, Congnan Luo, Soon M. Chung', 2008, 'Extended the X2 term-category indepen-\r\ndence test', 'Extended the X2 term-category independence test by introducing new statistical data that can measure whether the dependency between a term and a category is positive or negative, developed a new supervised feature selection method, named CHIR, which is based on the X2 statistic and the new term-category dependency measure.', 'Text Clustering', 'Five test data sets(CACM, MED, EXC, PEO and TOP)', 'Two data sets,CACM and MED, are extracted from the CACM and MEDLINE abstracts, respectively, which are included in the Classic database. Additional three data sets, EXC, PEO and TOP,are from the EXCHANGES, PEOPLE and TOPICS category sets\r\nof the Reuters-21578 Distribution 1.0', 'TCFS', 'Text Clustering with Feature Selection (TCFS), which performs the clustering and the supervised feature selection alternately until convergence.', 'CHIR consistently out-performs other three methods in terms of increasing the cohesiveness values of the clusters.', ''),
(12, 'Clustering-Based Feature Selection in Semi-supervised Problems', 'Ianisse Quinzán, José M. Sotoca, Filiberto Pla ', 2009, 'Unlabeled information can improve significant classification result', 'Unlabeled information can improve significant classification result', 'Clustering Feature Selection', 'Gisette, Optdigits, covtype, hyperspectral image', 'Gisette is a big data in the UCI repository, with 5000 attributes and 13500 objects, 7000 of them labelled. Optdigits problem is about the recognition of a handwritten number. The database has 5620 samples and 64 features.Covtype database, the objective is predicting forest \r\ncover type from cartographic variables, with no remotely sensed data. This database has 54 features, 581012 objects and 7 classes. A hyperspectral image called 92AV3C corresponding to a spectral image (145 x 145 pixels, 220 bands, and 17 classes).', 'Hybrid method (combines supervised and \r\nunsupervised measures of information)', 'A new hybrid method for semi-supervised \r\nproblem which combines supervised and unsupervised measures of information. This approach applies a strategy to obtain a feature subset through clustering techniques.', 'The unsupervised information improves the accuracy and the ssfc method is adequate.\r\nOptdigits is a database where sup technique gets high-quality features for few labeled samples. Thus, in this case \r\nthe ssfc has similar performance than sup. Nevertheless when the number of labeled samples is increased, ssfc and sup become similar to supT. ', ''),
(13, 'A Discrete Particle Swarm Optimization Algorithm for Domain Independent Linear Text Segmentation', 'Ji-Wei Wu, Judy C.R. Tseng, Wen-Nung Tsai ', 2010, 'Improve the performance of linear text segmentation', 'Improve the performance of linear text segmentation', 'Discrete Particle Swarm', 'GCE-2004 dataset', 'Choi test corpus consists of 700 samples. A sample is a concatenation of ten text segments and each segment is the first in sentences of a randomly selected document from the Brown corpus.', 'DPSO-SEG', 'The goal of DPSO-SEG is to identify the optimal topic boundaries of the text segments in a document.  At first, the \r\nterms within each sentence are tokenized and stemmed. Then, generic stop words are removed.  After the basic \r\npreprocessing, each sentence is represented as a term-frequency vector. Then, sentence-sentence similarity \r\nbetween a pair of sentences is computed by cosine similarity. A sentence similarity matrix of the text then constructed using the sentence-sentence similarity. Finally, the optimal \r\nboundaries are created by DPSO according to the sentence similarity matrix. ', 'The value of Pk is reduced sharply with fewer numbers of iterations, and smoothly after 350 iterations. It is converged at about 1500 iterations. the performance of DPSO-SEGC99 is better than DPSO-SEG. DPSO-SEGC99 also converges faster.', ''),
(14, 'First Order Statistics Based Feature Selection: A Diverse and Powerful Family of Feature Seleciton Techniques', 'Taghi Khoshgoftaar, David Dittman, Randall Wald, and Alireza Fazelpour', 2012, 'First Order Statistics (FOS) based feature selection', 'First Order Statistics (FOS) based feature selection using seven related univariate\r\nfeature selection metrics', 'First Order Statistics', 'DNA microarray', 'The datasets are all DNA microarray datasets acquired from a number of different real world bioinformatics, genetics, and medical projects. Use datasets with two classes for example:\r\ncancerous/non-cancerous or relapse/no relapse). ', 'Datasets, feature subset size, similarity measure, and classification', 'Datasets, feature subset size, similarity measure, and classification', 'Twenty one possible pairwise comparisons only one combination is above a 0.7 similarity across all twelve feature subset sizes: Fold Change Difference and SAM. Outside of this pair only four other pairs (S2N and Welch T Statistic, Signal to Noise and SAM, Fold Change Difference and Fisher Score, and Welch T Statistic and SAM) achieve a similarity score above 0.7 and only the combination of Welch T Statistic and Fisher Score achieves this below a feature subset size of 500', ''),
(15, 'Relation extraction using dependency parse trees', 'Katrin Fundel, Robert Ku¨ffner, Ralf Zimmer', 2007, 'Relation extraction from free text', 'The use of dependency parse trees as a means for biomedical relation extraction from free text. It is based on natural language preprocessing producing dependency parse trees and applying a small number of simple rules to these trees. ', 'Relation Extraction', 'Synonym dictionary for genes/proteins', 'Synonym dictionary for genes/proteins, a training set (55 sentences and 103 interactions) and a test set (80 sentences and 54 interactions).', 'Effector-relation-effectee, relation-of-effectee-by-effector, relation-between-effector-and-effectee', '(1) effector-relation-effectee (‘A activates B’)\r\n(2) relation-of-effectee-by-effector (‘Activation of A by B’)\r\n(3) relation-between-effector-and-effectee (‘Interaction between A\r\nand B’).', 'HPRD, even though being a very large\r\nand valuable source for protein interaction data, currently covers\r\nonly a small part of the human protein-protein relations from very limited relation categories. RelEx provides complementary information.', ''),
(16, 'Exploiting Constituent Dependencies for Tree Kernel-Based Semantic Relation Extraction', 'Longhua Qian   Guodong Zhou   Fang Kong   Qiaoming Zhu   Peide Qian ', 2010, 'Dynamically determine the tree span for relation extraction by exploiting constituent dependencies', 'Dynamically determine the tree span for relation extraction by exploiting constituent dependencies to integrate dependency information, which has been proven very useful to relation extraction, with the structured syntactic information to construct a concise and effective tree span specifically targeted for relation extraction. Explore interesting combined entity features for relation extraction via a unified parse and semantic tree. ', 'Constituent Dependencies', 'GCE-2004 dataset', 'ACE RDC 2004 corpus as the benchmark data that contains 451 documents and 5702 relation instances. It defines 7 entity types, 7 major relation types and 23 subtypes', 'Condense NounPhrases (NPs)\r\n', '(1) Modification within base-NPs \r\n(2) Modification to NPs\r\n(3)Arguments/adjuncts to verbs\r\n(4)Coordination conjunctions\r\n(5)Modification to other constituents', 'the improvements of different tree setups over SPT. DSPT performs best among DSPT, SPT, CS-SPT. It also shows that the Unified Parse and Semantic Tree with Feature-Paired Tree perform significantly better than the other two tree setups (i.e., CS-SPT and DSPT).', ''),
(17, 'Exploiting Background Knowledge for Relation Extraction', 'Yee Seng Chan and Dan Roth', 2010, 'Supervised RE', 'Improve the performance of RE by considering the relationship between our relations of interest, as well as how they relate to some existing knowledge resources', 'Background Knowledge', 'GCE-2004 dataset', 'ACE-2004 dataset (catalog LDC2005T09 from the Linguistic Data Consortium) to conduct our experiments. ACE-2004 defines 7 coarse-grained relations and 23 fine-grained relations', 'Coarse-grained predictions', 'Using the coarse-grained predictions which should intuitively be more reliable, to improve the fine-grained predictions.Using Novel to contrain the predictions of the fine-grained.', 'Performing the usual evaluation on mentions gives similar performance figures. All the background knowledge helped to improve performance, providing a total improvement of 3.9 to our basic RE system. Improves the performance of coarse-grained relation predictions.', ''),
(18, 'Automatic Evaluation of Relation Extraction Systems on Large-scale', 'Mirko Bronzi, Zhaochen Guo, Filipe Mesquita', 2012, 'Framework for large-scale evaluation of relation extraction systems', 'Framework for large-scale\r\nevaluation of relation extraction systems based on an automatic annotator that uses a public online database and a large web corpus.', 'Automatic Evaluation', 'ReVerb and SONEX', 'Compare two open RE systems: ReVerb and SONEX. The input corpus for this comparison is the New York Times corpus, composed by 1.8 million documents. ReVerb  extracts relational phrases using rules over part-of-speech tags and noun-phrase chunks.', 'Automatic annotator', 'Use of an automatic annotator: a system capable of verifying whether or not a fact was correctly extracted. This is done by leveraging external sources of data and text, which are not available to the systems being evaluated', 'About 63 million facts in G'', the superset of the ground truth G. ', ''),
(19, 'Confidence Estimation Methods for Partially Supervised Relation Extraction', 'Eugene Agichtein', 2006, 'Extract structured relations between named entities', 'Extract structured relations between named entities (e.g., a company name, a location name, or a name of a drug or a disease) from unstructured documents with minimal human effort. ', 'Partially Supervised Relation Extraction', 'Three relations extracted', 'Three relations extracted from a collection of 145,000 articles from the New York Times from 1996, available as part of the North American News Text Corpus1.', 'Expectation Maximization (EM)', 'Expectation Maximization (EM) algorithms for estimating pattern and tuple confidence.', 'The EM-based methods have higher accuracy than the constraint-based method', ''),
(20, 'A New Approach to Word Sense Disambiguation Based on Context Similarity ', 'M. Nameh, S.M. Fakhrahmad, M. Zolghadri Jahromi', 2011, 'Improve accuracy in WSD', 'The human mind is able to select the proper target equivalent of any source \r\nlanguage word by comprehension of the context.\r\n<br/>\r\nIn order to simulate this behavior in a machine, a huge amount of data will be required as input and the output may still not be free from errors.', 'Context Similarity ', 'TWA sense tagged data', 'In order to evaluate the proposed scheme, we used TWA sense tagged data which is a benchmark corpus developed at University of North Texas by Mihalcea and Yang in 2003. ', 'Inner product of vectors algorithm', 'Inner product of vectors algorithm. The proposed scheme is a supervised approach in which sense-tagged data is used to train the classifier.', 'The results are promising compared to the methods existing in the literature and were encouraging in most cases.  ', ''),
(21, 'Unsupervised Word Sense Disambiguation Using Neighborhood Knowledge', 'Huang Heyan, Yang Zhizhuo, Jian Ping', 2011, 'context window size', 'It has been proved that expanding context window size around the target ambiguous word can help to enhance the WSD performance. However, expanding window size unboundedly will bring not only useful information but also some noise which may finally deteriorate the WSD performance. ', 'Neighborhood Knowledge', 'Sogou Chinese collocation relation', 'In the experiment, Sogou Chinese collocation relation was used to compute mutual information of words. ', 'Hierarchical learning strategy', 'This study proposes to construct an appropriate knowledge context for unsupervised WSD method by making use of a few neighbor sentences closed to the ambiguous sentence in the article.', 'The neighborhood knowledge can significantly improve the performance of single sentence WSD.', ''),
(32, 'Semi-supervised Relation Extraction with Large-scale Word Clustering', 'Ang Sun, Ralph Grishman, Satoshi Sekine', 2011, 'Semi-supervised Relation Extraction with Large-scale Word Clustering', 'Cluster-based features in a systematic way ,several statistical methods for selecting effective clusters, impact of the size of training data on cluster features, analyze the performance improvements through an extensive experimental study.', 'Word Clustering', 'ACE 2004', 'We used TDT5 unlabeled data for \r\ninducing word clusters. It contains roughly 83 million words in 3.4 million sentences with a vocabulary size of 450K. We induced 1,000 word clusters for words that appeared at least twice in \r\nthe corpora. The reduced vocabulary contains 255K unique words.For relation extraction, we used the benchmark ACE 2004 training data. ', 'Hierarchical learning strategy', 'Simple learning framework that is similar to the hierarchical learning strategy. Specifically, train a binary classifier to distinguish between relation instances and non-relation instances. Then use only the annotated relation instances to train a multi-class classifier for the 7 relation types.', 'Zhou et al.(2007) : 78.2(P%) 63.4(R%) 70.1(F%)<BR/>\r\nZhao and Grishman (2005) : 69.2(P%) 71.5(R%) 70.4(F%)<BR/>\r\nOur Baseline : 73.4(P%) 67.7(R%) 70.4(F%)\r\nJiang and Zhai(2007) : 72.4(P%) 70.2(R%) 71.3(F%)', '');

-- --------------------------------------------------------

--
-- Table structure for table `metadata_penelitian`
--

CREATE TABLE IF NOT EXISTS `metadata_penelitian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `col_name` text NOT NULL,
  `deskripsi` text NOT NULL,
  `flag` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `metadata_penelitian`
--

INSERT INTO `metadata_penelitian` (`id`, `col_name`, `deskripsi`, `flag`) VALUES
(1, 'judul', 'Judul', 1),
(2, 'tahun_publikasi', 'Tahun Publikasi', 1),
(5, 'domain_data', 'Domain Data', 1),
(8, 'metode', 'Metode', 1),
(9, 'hasil', 'Hasil', 0),
(13, 'masalah', 'Masalah', 1),
(14, 'citation', 'Citation', 0),
(15, 'peneliti', 'Peneliti', 1),
(16, 'keyword', 'Keyword', 0),
(17, 'deskripsi_domain_data', 'Deskripsi Domain Data', 0),
(18, 'deskripsi_metode', 'Deskripsi Metode', 0),
(19, 'deskripsi_masalah', 'Deskripsi Masalah', 0);

-- --------------------------------------------------------

--
-- Table structure for table `metadata_relasi`
--

CREATE TABLE IF NOT EXISTS `metadata_relasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `metadata_relasi`
--

INSERT INTO `metadata_relasi` (`id`, `deskripsi`, `keterangan`) VALUES
(1, 'Citation', 'Relasi menunjukkan paper satu merujuk ke paper lain'),
(2, 'Improvement', 'Relasi peningkatan hasil satu paper ke paper lain\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE IF NOT EXISTS `relasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_relasi` int(11) NOT NULL,
  `id_paper_1` int(11) NOT NULL,
  `id_paper_2` int(11) NOT NULL,
  `creater` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`id`, `id_relasi`, `id_paper_1`, `id_paper_2`, `creater`) VALUES
(1, 2, 12, 11, '7'),
(2, 1, 1, 2, ''),
(3, 2, 12, 15, ''),
(4, 2, 1, 2, ''),
(5, 1, 2, 1, ''),
(6, 1, 2, 6, ''),
(7, 1, 2, 20, ''),
(9, 1, 10, 11, ''),
(10, 1, 12, 4, ''),
(11, 1, 11, 10, '1'),
(12, 1, 2, 11, '1'),
(13, 1, 8, 12, '1');

-- --------------------------------------------------------

--
-- Table structure for table `saved_map`
--

CREATE TABLE IF NOT EXISTS `saved_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_paper` text NOT NULL,
  `parameter_x` text NOT NULL,
  `parameter_y` text NOT NULL,
  `parameter_relation` text NOT NULL,
  `map_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `saved_map`
--

INSERT INTO `saved_map` (`id`, `id_user`, `id_paper`, `parameter_x`, `parameter_y`, `parameter_relation`, `map_name`) VALUES
(1, 7, '2,32,8,11,12,10', 'Domain Data', 'Tahun Publikasi', 'Citation', 'Text Clustering'),
(16, 7, '8,10,11,12,13,14,15,16,17,18,19', 'Domain Data', 'Tahun Publikasi', 'Citation', 'Text Categorization'),
(17, 7, '8,10,11,12,13,14,15,16,17,18,19,3,5,6', 'Peneliti', 'Tahun Publikasi', 'Citation', 'Summarization'),
(18, 7, '2,8,10,11,12,32,6', 'Domain Data', 'Tahun Publikasi', 'Citation', 'Word Similarity');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `birthday`) VALUES
(1, 'Admin', 'Administrator', '0000-00-00'),
(2, 'Demo', 'Demo', '0000-00-00'),
(3, 'anti', 'yuli', '2014-09-24'),
(4, 'anti', 'yuli', '2014-09-29'),
(5, 'oenang', 'yulianti', '2014-10-07'),
(6, 'oenang', 'yulianti', '2014-10-05'),
(7, 'oenang', 'yulianti', '2014-10-05'),
(8, 'oenang', 'yulianti', '2014-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'birthday', 'Birthday', 'DATE', 0, 0, 2, '', '', '', '', '0000-00-00', 'UWjuidate', '{"ui-theme":"redmond"}', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '9a24eff8c15a6a141ece27eb6947da0f', 1261146094, 1415770742, 1, 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', 1261146096, 0, 0, 1),
(7, 'yuli', 'f58a4d09485609a22c50547646e5282b', 'yuliantioenang@gmail.com', '4612463b486a397bb8299538cd9f1688', 1412464248, 1415770753, 0, 1),
(8, 'yulianti', 'f58a4d09485609a22c50547646e5282b', 'yulianti@gmail.com', '800026964f7703ebec75fd8250494ffa', 1412584709, 1412584709, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
