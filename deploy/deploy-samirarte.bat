@echo off
setlocal

echo ==========================================
echo Despliegue tema Samirarte Boutique a Hostalia
echo ==========================================
echo.

set "PROJECT_DIR=C:\Samirarte-wp"
set "THEME_DIR=%PROJECT_DIR%\samirarte-boutique"
set "DEPLOY_DIR=%PROJECT_DIR%\deploy"
set "SCRIPT_FILE=%DEPLOY_DIR%\deploy-samirarte.txt"
set "LOG_FILE=%DEPLOY_DIR%\deploy.log"

set "WINSCP_EXE=C:\Program Files (x86)\WinSCP\WinSCP.com"
if not exist "%WINSCP_EXE%" set "WINSCP_EXE=C:\Program Files\WinSCP\WinSCP.com"

if not exist "%WINSCP_EXE%" (
    echo ERROR: No se encuentra WinSCP.com.
    pause
    exit /b 1
)

if not exist "%SCRIPT_FILE%" (
    echo ERROR: No existe el script:
    echo %SCRIPT_FILE%
    pause
    exit /b 1
)

if not exist "%THEME_DIR%" (
    echo ERROR: No existe la carpeta local del tema:
    echo %THEME_DIR%
    pause
    exit /b 1
)

if not exist "%THEME_DIR%\style.css" (
    echo ERROR: No existe style.css en la raiz del tema:
    echo %THEME_DIR%\style.css
    pause
    exit /b 1
)

if exist "%THEME_DIR%\samirarte-boutique" (
    echo ERROR: Existe un duplicado interno:
    echo %THEME_DIR%\samirarte-boutique
    echo Borralo o muevelo antes de desplegar.
    pause
    exit /b 1
)

echo Ejecutando WinSCP...
echo Log: %LOG_FILE%
echo.

"%WINSCP_EXE%" /ini=nul /script="%SCRIPT_FILE%" /log="%LOG_FILE%"

set "EXITCODE=%ERRORLEVEL%"

echo.
echo ==========================================
echo WinSCP termino con codigo: %EXITCODE%
echo ==========================================
echo.

if not "%EXITCODE%"=="0" (
    echo Ha habido un error. Abriendo log...
    notepad "%LOG_FILE%"
    pause
    exit /b %EXITCODE%
)



echo Despliegue terminado correctamente.
pause
exit /b 0
