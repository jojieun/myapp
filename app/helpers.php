<?php
if (! function_exists('attachments_path')) {
    /**
     * Generate attachments path.
     *
     * @param string $path
     * @return string
     */
    function attachments_path($path = null)
    {
        return public_path('files'.($path ? DIRECTORY_SEPARATOR.$path : $path));
    }
    
}
?>