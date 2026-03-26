#!/bin/bash

# ==========================================
# FLUX CORE ENGINE - COMMAND LINE INTERFACE
# ==========================================

# ANSI Colors
GREEN='\033[0;32m'
GOLD='\033[0;33m'
RED='\033[0;31m'
CYAN='\033[0;36m'
NC='\033[0m'

# Check if deploy.sh exists
if [ ! -f "deploy.sh" ]; then
    echo -e "${RED}FEHLER: deploy.sh nicht gefunden!${NC}"
    exit 1
fi

case "$1" in
    watch)
        clear
        echo -e "${CYAN}["$(date +'%H:%M:%S')"]${NC} ${GOLD}>> INITIATING SLIPSPACE AUTO-SYNC DAEMON...${NC}"
        say -v Anna "Auto-Deployment aktiviert. Überwache Sektoren auf Veränderungen."
        
        LAST_HASH=""
        
        # Loop to watch for file modifications
        while true; do
            # Generate a hash of all file modification timestamps in the theme folder
            CURRENT_HASH=$(find html/wp-content/themes/ki-labor -type f -print0 | xargs -0 stat -f "%m" | md5)
            
            # If last hash is set and differs from current, a file was modified
            if [ "$LAST_HASH" != "" ] && [ "$CURRENT_HASH" != "$LAST_HASH" ]; then
                echo -e "\n${CYAN}["$(date +'%H:%M:%S')"]${NC} ${RED}>> SYSTEM ANOMALY DETECTED (FILE MODIFIED). COMPILING FLUX...${NC}"
                say -v Anna "Theme-Quellcode verändert. Slipspace-Tunnel wird geöffnet."
                
                # Execute slipspace deployment
                ./deploy.sh
                
                echo -e "${CYAN}["$(date +'%H:%M:%S')"]${NC} ${GREEN}>> WEBSPACE IN SYNC. WAITING FOR NEXT ANOMALY...${NC}"
                say -v Anna "Synchronisation erfolgreich."
            fi
            
            LAST_HASH=$CURRENT_HASH
            sleep 2
        done
        ;;

    glitch)
        clear
        echo -e "${GREEN}>> INITIATING MATRIX LOG DECRYPTION...${NC}"
        say -v Anna "Matrix-Datenstrom wird eingeleitet."
        # Generate random hex strings mimicking a deep-level hack, cascading down
        for i in {1..20}; do
            head -c 100 /dev/urandom | xxd -p | tr -d '\n' | awk '{print "\033[0;32m" $0 "\033[0m"}'
            sleep 0.05
            echo ""
        done
        echo -e "\n${RED}>> SYSTEM BREACH SUCCESSFUL. IDENTITY: SASCHA RODE.${NC}"
        say -v Anna "Zugriff gewährt, Overlord."
        ;;

    status)
        echo -e "\n${GOLD}[ FLUX CORE STATUS ]${NC}"
        echo -e "${CYAN}🧠 NPU USAGE:${NC} OVERCLOCKED (GLOWING RED)"
        echo -e "${CYAN}🔋 NEURAL LINK:${NC} ACTIVE (0ms LATENCY)"
        echo -e "${CYAN}📂 THEME STATUS:${NC} MINIMAL & FLAWLESS"
        echo -e "${CYAN}🚀 SLIPSPACE:${NC} ONLINE & PENDING COMMAND\n"
        ;;

    *)
        echo -e "${GOLD}FLUX CORE CLI v1.0${NC}\n"
        echo -e "Usage: ${GREEN}./flux.sh${NC} [command]\n"
        echo "Commands:"
        echo -e "  ${CYAN}watch${NC}  : Starts the Auto-Deploy Daemon (watches your code and deploys on save)"
        echo -e "  ${CYAN}glitch${NC} : Triggers a terminal Matrix effect (pure visual anarchy)"
        echo -e "  ${CYAN}status${NC} : Reads NPU and Neural Link state"
        echo ""
        ;;
esac
