#!/bin/sh
# https://docs.oracle.com/cd/F39414_01/xeinl/installing-oracle-database-xe.html#GUID-728E4F0A-DBD1-43B1-9837-C6A460432733
# https://www.oracle.com/database/technologies/xe-downloads.html
# https://www.shift-the-oracle.com/config/oracle-environment-variable.html

ORA_VER=xe-21c
ORA_RPM="oracle-database-${ORA_VER}-1.0-1.ol8.x86_64.rpm"
ORA_URL="https://download.oracle.com/otn-pub/otn_software/db-express/${ORA_RPM}"
ORA_PASS=Passw0rd

test -e "${ORA_RPM}" || {
    echo "download ${ORA_URL}"
    wget --quiet "${ORA_URL}"
}
dnf -y install "${ORA_RPM}"
{
    echo "${ORA_PASS}"
    echo "${ORA_PASS}"
} | /etc/init.d/oracle-${ORA_VER} configure


doc() {
    cat <<'EOF'

##### writed by my oracle installer #####
export ORACLE_BASE=/opt/oracle
export ORACLE_HOME=${ORACLE_BASE}/product/21c/dbhomeXE
export ORACLE_SID=XE
export ORAENV_ASK=NO

PATH="${ORACLE_HOME}/bin:${PATH}"
#########################################
EOF
}

insert() {
    grep 'writed by my oracle installer' "$1" || doc >> "$1"
}

insert /root/.bashrc
insert /home/vagrant/.bashrc

systemctl daemon-reload
systemctl enable oracle-xe-21c
systemctl restart oracle-xe-21c
