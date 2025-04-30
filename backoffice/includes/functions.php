<?php
// backoffice/includes/functions.php

/**
 * Récupère le paramètre de recherche dans $_GET et le nettoie.
 */
function getSearchParam(string $key = 'search'): string {
    return trim($_GET[$key] ?? '');
}

/**
 * Construit un fragment SQL WHERE pour rechercher $columns
 * en comparant chacun à la valeur de recherche.
 * Retourne une chaîne vide si la recherche est vide.
 */
function buildSearchWhere(array $columns, mysqli $conn, string $param = 'search'): string {
    $term = getSearchParam($param);
    if ($term === '') {
        return '';
    }
    $esc = mysqli_real_escape_string($conn, $term);
    $clauses = array_map(fn($col) => "$col LIKE '%$esc%'", $columns);
    return ' WHERE ' . implode(' OR ', $clauses);
}

/**
 * Affiche le HTML de la barre de recherche.
 */
function renderSearchForm(
    string $action = '',
    string $name        = 'search',
    string $placeholder = 'Rechercher…'
): void {
    $value = htmlspecialchars(getSearchParam($name), ENT_QUOTES);
    echo <<<HTML
<form method="get" action="$action" class="search-container">
  <input
    type="search"
    name="$name"
    placeholder="$placeholder"
    value="$value"
  >
  <button type="submit">🔍</button>
</form>
HTML;
}
