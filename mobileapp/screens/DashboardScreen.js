import React, { useLayoutEffect, useState, useEffect } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text, TouchableOpacity, Modal, StyleSheet, ImageBackground, StatusBar } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';
import BookingsScreen from './BookingsScreen';
import CustomerScreen from './CustomerScreen';
import PaymentScreen from './PaymentScreen';
import SubMenu from './SubMenu';
import { LineChart } from 'react-native-chart-kit';
import { Dimensions } from 'react-native';

const Tab = createBottomTabNavigator();

const DataCard = ({ title, value, icon }) => (
  <View style={styles.dataCard}>
    <FontAwesome5 name={icon} size={24} color="#3498db" style={styles.dataCardIcon} />
    <Text style={styles.dataCardTitle}>{title}</Text>
    <Text style={styles.dataCardValue}>{value}</Text>
  </View>
);

const DashboardScreen = ({ navigation }) => {
  const [isLogoutModalVisible, setLogoutModalVisible] = useState(false);
  const [showSubMenu, setShowSubMenu] = useState(false);
  

  useLayoutEffect(() => {
    navigation.setOptions({
      headerRight: () => (
        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
          <TouchableOpacity onPress={() => setShowSubMenu(true)}>
            <FontAwesome5 name="cog" size={24} color="#3498db" style={{ marginRight: 15 }} />
          </TouchableOpacity>
        </View>
      ),
      headerLeft: () => null,
    });
  }, [navigation, setLogoutModalVisible, showSubMenu]);

  

  const handleLogout = () => {
    // Implement your logout logic here
    // After logout, navigate to the login screen
    navigation.navigate('Login'); // Replace 'Login' with the actual name of your login screen
  };

  const handleProfile = () => {
    // Implement navigation to the profile screen
    // For now, it just navigates to a placeholder screen named 'Profile'
    navigation.navigate('Profile'); // Replace 'Profile' with the actual name of your profile screen
    setShowSubMenu(false);
  };

  const handleCloseSubMenu = () => {
    setShowSubMenu(false);
  };

  return (
    <View style={{ flex: 1 }}>
      <StatusBar barStyle="light-content" />
      <Tab.Navigator>
        <Tab.Screen
          name="Dashboard"
          component={DashboardContent}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="home" color={color} size={size} />
            ),
          }}
        />
        
        <Tab.Screen
          name="Customers"
          component={CustomerScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="users" color={color} size={size} />
            ),
          }}
        />
        <Tab.Screen
          name="Bookings"
          component={BookingsScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="calendar" color={color} size={size} />
            ),
          }}
        />
        <Tab.Screen
          name="Payments"
          component={PaymentScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="credit-card" color={color} size={size} />
            ),
          }}
        />
      </Tab.Navigator>

      {showSubMenu && (
        <SubMenu
          onClose={handleCloseSubMenu}
          onProfilePress={handleProfile}
          onLogoutPress={() => setLogoutModalVisible(true)}
        />
      )}

      <Modal transparent={true} visible={isLogoutModalVisible} animationType="slide">
        <View style={styles.modalContainer}>
          <View style={styles.modalContent}>
            <Text>Are you sure you want to logout?</Text>
            <View style={styles.buttonContainer}>
              <TouchableOpacity onPress={handleLogout}>
                <Text style={styles.logoutButton}>Logout</Text>
              </TouchableOpacity>
              <TouchableOpacity onPress={() => setLogoutModalVisible(false)}>
                <Text style={styles.cancelButton}>Cancel</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>

      {/* Use DataCard components with updated values */}
     
    </View>
  );
};

const styles = StyleSheet.create({
  dataCard: {
    width: '48%',
    backgroundColor: 'white',
    padding: 15,
    borderRadius: 10,
    elevation: 5,
    marginBottom: 20,
    alignItems: 'center',
  },
  dataCardIcon: {
    marginBottom: 10,
  },
  dataCardTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
  dataCardValue: {
    fontSize: 18,
    color: '#3498db',
  },
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5,
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    marginTop: 10,
  },
  logoutButton: {
    color: 'red',
    fontSize: 16,
  },
  cancelButton: {
    color: 'blue',
    fontSize: 16,
  },
});

const DashboardContent = () => {
  const backgroundImage = require("../assets/bg2.jpg");
  const [totalBookings, setTotalBookings] = useState(0);
  const [totalCustomers, setTotalCustomers] = useState(0);
  const [totalRevenue, setTotalRevenue] = useState(0);
  const [paidBookings, setPaidBookings] = useState(0);
  const [orderData, setOrderData] = useState([]);

  useEffect(() => {
    // Fetch data from your endpoint here
    const fetchData = async () => {
      try {
        const response = await fetch('http://192.168.0.9:3001/api/totalBookings'); 
        const response1 = await fetch('http://192.168.0.9:3001/api/totalCustomers'); 
        const response2 = await fetch('http://192.168.0.9:3001/api/totalRevenue'); 
        const response3 = await fetch('http://192.168.0.9:3001/api/totalPaid'); 
        const data = await response.json();
        const data1 = await response1.json();
        const data2 = await response2.json();
        const data3 = await response3.json();

        // Assuming your API response has fields like totalBookings, totalCustomers, totalRevenue, and paidBookings
        setTotalBookings(data.totalBookings || 0);
        setTotalCustomers(data1.totalCustomers || 0);
        setTotalRevenue(data2.totalRevenue || 0);
        setPaidBookings(data3.totalPaid || 0);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch('http://192.168.0.9:3001/api/graph'); // Replace with your actual API endpoint
        const data = await response.json();

        // Assuming your API response has an array of orders with 'orderid' and 'amount' fields
        setOrderData(data.orders || []);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []);

  const orderidData = orderData.map(order => order.orderid);
  const amountData = orderData.map(order => order.amount);

  const chartData = {
    labels: orderidData,
    datasets: [
      {
        data: amountData,
      },
    ],
  };
  
  return (
    <ImageBackground source={backgroundImage} style={{ flex: 1, resizeMode: 'cover' }}>
      <View style={{ flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-around', marginTop: 20 }}>
        <DataCard title="Total Bookings" value={totalBookings.toString()} icon="book" />
        <DataCard title="Total Customers" value={totalCustomers.toString()} icon="users" />
        <DataCard title="Total Revenue" value={`₹${totalRevenue}`} icon="rupee-sign" />
        <DataCard title="Paid Bookings" value={paidBookings.toString()} icon="info" />
      </View>
    </ImageBackground>
  );
};


export default DashboardScreen;
