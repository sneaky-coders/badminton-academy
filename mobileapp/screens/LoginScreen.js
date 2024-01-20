// LoginScreen.js
import React, { useState } from "react";
import { View, ImageBackground, StyleSheet, Alert } from "react-native";
import { Input, Button, Card } from "react-native-elements";

const backgroundImage = require("../assets/bg.png"); // Adjust the path based on your file location

const LoginScreen = ({ navigation }) => {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const handleLogin = async () => {
    try {
      const response = await fetch("http://192.168.0.9:3000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ username, password }),

        /*const response = await fetch('https://yourdomain.com/api/login', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({ username, password }),
});*/
      });

      const data = await response.json();

      if (response.ok) {
        // User successfully logged in
        Alert.alert("Login Successful");
        navigation.navigate("Dashboard");
        // Navigate to the Dashboard or perform other actions.
        // navigation.navigate('Dashboard');
      } else {
        // Handle login failure
        Alert.alert("Login Failed", data.error);
      }
    } catch (error) {
      console.error("Error during login:", error);
    }
  };

  return (
    <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
      <View style={styles.container}>
        <Card containerStyle={styles.cardContainer}>
          <Card.Title h4>Login</Card.Title>
          <Input
            placeholder="Username"
            value={username}
            onChangeText={(text) => setUsername(text)}
            leftIcon={{ type: "font-awesome", name: "user" }}
          />
          <Input
            placeholder="Password"
            value={password}
            onChangeText={(text) => setPassword(text)}
            secureTextEntry
            leftIcon={{ type: "font-awesome", name: "lock" }}
          />
          <Button title="Login" onPress={handleLogin} />
        </Card>
      </View>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
  },
  backgroundImage: {
    flex: 1,
    resizeMode: "cover",
    justifyContent: "center",
  },
  cardContainer: {
    backgroundColor: "rgba(255, 255, 255, 0.8)",
    borderRadius: 10,
    padding: 20,
    width: 300,
  },
});

export default LoginScreen;
