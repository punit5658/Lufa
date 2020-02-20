SELECT
  final.DATE,
  COUNT(final.`asset`) AS `Number of unreturned asset`
FROM
  (
  SELECT
    DATE_FORMAT(
      MAX(asset_activity.created),
      '%Y-%m-%d'
    ) AS DATE,
    COUNT(asset_activity.asset_id) AS `asset`
  FROM
    asset_activity
  INNER JOIN
    asset ON asset.asset_id = asset_activity.asset_id AND asset.type_id = 1
  WHERE
    asset_activity.location_id = 3
  GROUP BY
    asset_activity.asset_id
  ORDER BY
    DATE ASC
) AS final
GROUP BY
  final.DATE
