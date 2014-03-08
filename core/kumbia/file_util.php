<?php
/**
 * KumbiaPHP web & app Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://wiki.kumbiaphp.com/Licencia
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@kumbiaphp.com so we can send you a copy immediately.
 * 
 * @category   Kumbia
 * @package    Core 
 * @copyright  Copyright (c) 2005-2012 Kumbia Team (http://www.kumbiaphp.com)
 * @license    http://wiki.kumbiaphp.com/Licencia     New BSD License
 */

/**
 * Utilidades para el manejo de ficheros y directorios
 * @category   Kumbia
 * @package    Core
 */
class FileUtil
{ 
    /**
     * Crea un path en caso de que no exista
     *
     * @param string $path ruta a crear
     * @todo Esto se puede optimizar
     * @return boolean
     */
    public static function mkdir($path)
    {
        if (file_exists($path) or @mkdir($path))
            return TRUE;
        return (self::mkdir(dirname($path)) and mkdir($path));
    }

    /**
     * Elimina un directorio.
     *
     * @param string $dir ruta de directorio a eliminar
     * @todo Esto se puede optimizar
     * @return boolean
     */
    public static function rmdir($dir)
    {
        // Obtengo los archivos en el directorio a eliminar
        if ($files = array_merge(glob("$dir/*"), glob("$dir/.*"))) {
            // Elimino cada subdirectorio o archivo
            foreach ($files as $file) {
                // Si no son los directorios "." o ".." 
                if (!preg_match("/^.*\/?[\.]{1,2}$/", $file)) {
                    if (is_dir($file)) {
                        return self::removedir($file);
                    } elseif (!@unlink($file)) {
                        return FALSE;
                    }
                }
            }
        }
        return @rmdir($dir);
    }
}
