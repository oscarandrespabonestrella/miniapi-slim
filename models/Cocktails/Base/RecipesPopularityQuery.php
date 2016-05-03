<?php

namespace Cocktails\Base;

use \Exception;
use \PDO;
use Cocktails\RecipesPopularity as ChildRecipesPopularity;
use Cocktails\RecipesPopularityQuery as ChildRecipesPopularityQuery;
use Cocktails\Map\RecipesPopularityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'recipes_popularity' table.
 *
 * 
 *
 * @method     ChildRecipesPopularityQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildRecipesPopularityQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildRecipesPopularityQuery orderByFavorited($order = Criteria::ASC) Order by the favorited column
 *
 * @method     ChildRecipesPopularityQuery groupByUrl() Group by the url column
 * @method     ChildRecipesPopularityQuery groupByTitle() Group by the title column
 * @method     ChildRecipesPopularityQuery groupByFavorited() Group by the favorited column
 *
 * @method     ChildRecipesPopularityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRecipesPopularityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRecipesPopularityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRecipesPopularityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRecipesPopularityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRecipesPopularityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRecipesPopularity findOne(ConnectionInterface $con = null) Return the first ChildRecipesPopularity matching the query
 * @method     ChildRecipesPopularity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildRecipesPopularity matching the query, or a new ChildRecipesPopularity object populated from the query conditions when no match is found
 *
 * @method     ChildRecipesPopularity findOneByUrl(string $url) Return the first ChildRecipesPopularity filtered by the url column
 * @method     ChildRecipesPopularity findOneByTitle(string $title) Return the first ChildRecipesPopularity filtered by the title column
 * @method     ChildRecipesPopularity findOneByFavorited(int $favorited) Return the first ChildRecipesPopularity filtered by the favorited column *

 * @method     ChildRecipesPopularity requirePk($key, ConnectionInterface $con = null) Return the ChildRecipesPopularity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipesPopularity requireOne(ConnectionInterface $con = null) Return the first ChildRecipesPopularity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipesPopularity requireOneByUrl(string $url) Return the first ChildRecipesPopularity filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipesPopularity requireOneByTitle(string $title) Return the first ChildRecipesPopularity filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRecipesPopularity requireOneByFavorited(int $favorited) Return the first ChildRecipesPopularity filtered by the favorited column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRecipesPopularity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildRecipesPopularity objects based on current ModelCriteria
 * @method     ChildRecipesPopularity[]|ObjectCollection findByUrl(string $url) Return ChildRecipesPopularity objects filtered by the url column
 * @method     ChildRecipesPopularity[]|ObjectCollection findByTitle(string $title) Return ChildRecipesPopularity objects filtered by the title column
 * @method     ChildRecipesPopularity[]|ObjectCollection findByFavorited(int $favorited) Return ChildRecipesPopularity objects filtered by the favorited column
 * @method     ChildRecipesPopularity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class RecipesPopularityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Cocktails\Base\RecipesPopularityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Cocktails\\RecipesPopularity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRecipesPopularityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRecipesPopularityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildRecipesPopularityQuery) {
            return $criteria;
        }
        $query = new ChildRecipesPopularityQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$url, $title] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRecipesPopularity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RecipesPopularityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RecipesPopularityTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRecipesPopularity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT url, title, favorited FROM recipes_popularity WHERE url = :p0 AND title = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRecipesPopularity $obj */
            $obj = new ChildRecipesPopularity();
            $obj->hydrate($row);
            RecipesPopularityTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildRecipesPopularity|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(RecipesPopularityTableMap::COL_URL, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(RecipesPopularityTableMap::COL_TITLE, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(RecipesPopularityTableMap::COL_URL, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(RecipesPopularityTableMap::COL_TITLE, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RecipesPopularityTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RecipesPopularityTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the favorited column
     *
     * Example usage:
     * <code>
     * $query->filterByFavorited(1234); // WHERE favorited = 1234
     * $query->filterByFavorited(array(12, 34)); // WHERE favorited IN (12, 34)
     * $query->filterByFavorited(array('min' => 12)); // WHERE favorited > 12
     * </code>
     *
     * @param     mixed $favorited The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function filterByFavorited($favorited = null, $comparison = null)
    {
        if (is_array($favorited)) {
            $useMinMax = false;
            if (isset($favorited['min'])) {
                $this->addUsingAlias(RecipesPopularityTableMap::COL_FAVORITED, $favorited['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($favorited['max'])) {
                $this->addUsingAlias(RecipesPopularityTableMap::COL_FAVORITED, $favorited['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RecipesPopularityTableMap::COL_FAVORITED, $favorited, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildRecipesPopularity $recipesPopularity Object to remove from the list of results
     *
     * @return $this|ChildRecipesPopularityQuery The current query, for fluid interface
     */
    public function prune($recipesPopularity = null)
    {
        if ($recipesPopularity) {
            $this->addCond('pruneCond0', $this->getAliasedColName(RecipesPopularityTableMap::COL_URL), $recipesPopularity->getUrl(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(RecipesPopularityTableMap::COL_TITLE), $recipesPopularity->getTitle(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the recipes_popularity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipesPopularityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RecipesPopularityTableMap::clearInstancePool();
            RecipesPopularityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RecipesPopularityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RecipesPopularityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            RecipesPopularityTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            RecipesPopularityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // RecipesPopularityQuery
