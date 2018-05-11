<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Fichier de configuration de Igor
 * @author Thomas Sanctorum
 */

// Determine le chemin vers les fichiers sources, extra et assets
$config['src_path'] = 'src/';
$config['extra_path'] = 'src/extra/';
$config['assets_path'] = 'assets/';

// ---- ASSETS ---- //

/**
 * GLOBAL
 * Defini le nom des assets commun 
 */
$config['global'] = 'general';

// -- JavaScript -- //

/**
 * MINIFY
 * TRUE: utilise les assets minifie 
 * FALSE: utilise les fichiers source
 */
$config['minify'] = FALSE;

// ---- EXTRA ASSETS ---- //

/**
 * BUNDLE
 * TRUE: utilise un bundle (fichier concatene ) des assets extra
 * FALSE: utilise les extra non concatene ( NON RECOMMANDE )
 */
$config['extra_bundle'] = FALSE;

/**
 * ASSETS
 * Liste les extra (vendor) à utiliser
 * Si vous utiliser un bundle ( extra_bundle = TRUE ), vous n'avez pas de valeurs à remplir ici
 */
$config['extra_js'] = array('jquery-3.3.1.min.js','datatables.min.js');
$config['extra_css'] = 'bootstrap.min.css';